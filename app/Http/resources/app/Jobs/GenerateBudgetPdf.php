<?php

namespace App\Jobs;

use App\Enums\StatusBudgetEnum;
use App\Models\Budget;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function Spatie\LaravelPdf\Support\pdf;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use Illuminate\Support\Facades\File;

class GenerateBudgetPdf implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $budgetId;

    public $timeout = 60;
    public $tries = 3;

    /**
     * Create a new job instance.
     */
    public function __construct($budgetId)
    {
        $this->budgetId = $budgetId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Obtener el presupuesto
        $budget = Budget::with([
            'budgetems',
            'publicVisibleBudgetems',
            'publicVisibleProducts',
            'publicInvisibleBudgetems',
            'publicInvisibleProducts',
            'pdfResources',
            'products',
            'business',
            'customer'
        ])->find($this->budgetId);


        try {
            // Marcar el cliente como generando PDF
            $budget->update(['progress' => 10]);

            //Variables publicas para el pdf
            if (!File::exists(storage_path('tmp'))) {
                File::makeDirectory(storage_path('tmp'), 0775, true);
            }
            $budget->update(['progress' => 15]);

            // dd('paso aca');
            if ($budget) {
                // Generar el PDF utilizando la lógica del controlador
                // Puedes reutilizar el código del BudgetController aquí

                // Variables para el PDF

                // **Obtener ítems visibles e invisibles**
                $visibleItems = $budget->publicVisibleBudgetems->merge($budget->publicVisibleProducts);
                $invisibleItems = $budget->publicInvisibleBudgetems->merge($budget->publicInvisibleProducts);
                // **Ordenar los ítems por el campo 'order'**
                $budgetItems = $visibleItems->sortBy('pivot.order');
                $budgetInvisibleItems = $invisibleItems->sortBy('pivot.order');


                // **Calcular el total de los ítems invisibles**
                $totalBudgetInvisibleItems = $budgetInvisibleItems->sum(function ($item) {
                    return $item->pivot->total;
                });


                $budget->update(['progress' => 20]);

                // **Determinar si todos los ítems son invisibles**
                $totalItemsCount = $budget->budgetems->count() + $budget->products->count();
                $visibleItemsCount = $budgetItems->count();

                if ($visibleItemsCount === 0 && $totalItemsCount > 0) {
                    // Todos los ítems son invisibles
                    $onceItemTitle = $budget->once_item_title ?: 'Servicio';
                } else {
                    $onceItemTitle = null;
                }

            

                // Obtener el cliente asociado con el presupuesto
                $customer = $budget->customer;



                // Crear el nombre del archivo PDF basado en el nombre del negocio y el ID del presupuesto
                $pdfFileName = Str::slug($budget->name) .'-'. Str::slug($budget->id) . '.pdf';

                // Crear la estructura de directorios usando el slug del nombre del negocio
                $businessSlug = Str::slug($budget->business->name);

                // Definir la ruta donde se almacenará el PDF en el storage
                $pdfFilePath = '/' . $businessSlug . '/budgets/' . $pdfFileName;

                // Delete the existing merged PDF if it exists (sirve para el edit)
                if (Storage::exists($pdfFilePath)) {
                    Storage::delete($pdfFilePath);
                }

                // Verificar si el directorio de presupuestos no existe 
                if (!Storage::exists($businessSlug . '/budgets/')) {
                    // Crear el directorio de presupuestos
                    Storage::makeDirectory($businessSlug . '/budgets/');
                }
                $budget->update(['progress' => 30]);
                // Generar el contenido del PDF principal




                $pdf = pdf()
                    ->view('pdf.budget', [
                        'budget' => $budget,
                        'lead' => $customer,
                        'budgetItems' => $budgetItems,
                        'totalBudgetInvisibleItems' => $totalBudgetInvisibleItems,
                        'onceItemTitle' => $onceItemTitle,
                        'business' => $budget->business
                    ]);


                $countDocuments = DB::table('budget_pdf_resource')->where('budgetable_id', $budget->id)->count();

                // Actualizar el progreso del presupuesto
                $budget->update(['progress' => 40]);


                if ($countDocuments == 1) {
                    $pdf->disk('public')->save($pdfFilePath);
                } else {
                    $pdfContent = $pdf->getBrowsershot()->pdf();
                    // Inicializar el PDFMerger
                    $pdfMerger =  PDFMerger::init();

                    // Obtener la lista ordenada de PDFs para fusionar, incluyendo el PDF del presupuesto
                    $pdfsToMerge = $this->getPdfsToMerge($budget, $pdfContent);

                    $budget->update(['progress' => 60]);

                    // Agregar los PDFs al merger en el orden especificado
                    foreach ($pdfsToMerge as $pdfData) {
                        if ($pdfData['type'] === 'string') {
                            $pdfMerger->addString($pdfData['content'], 'all');
                        } elseif ($pdfData['type'] === 'file') {
                            $pdfMerger->addPDF($pdfData['path'], 'all');
                        }
                    }


                    $budget->update(['progress' => 80]);

                    // Fusionar los PDFs
                    $pdfMerger->merge();

                    // Guardar el PDF fusionado en el storage
                    $pdfMerger->save(storage_path('app/public' . $pdfFilePath));
                }

                //borrar tmp
                File::deleteDirectory(storage_path('tmp'), 0775, true);


                $budget->update(['progress' => 100]);
                // Marcar el cliente como no generando PDF
                $budget->update([
                    'status' => StatusBudgetEnum::GENERATED->value
                ]);
            }
        } catch (\Exception $e) {

            $budget->update([
                'status' => StatusBudgetEnum::ERROR->value
            ]);
        }
    }



    private function getPdfsToMerge(Budget $budget, $budgetPdfContent)
    {
        // Inicializar el array con el PDF del presupuesto
        $pdfsToMerge = [];

        // Obtener los recursos PDF asociados con su orden, incluyendo el PDF del presupuesto
        $pdfResources = $budget->pdfResources()->withPivot('order')->get();


        // Agregar los recursos PDF y el PDF del presupuesto al array
        foreach ($pdfResources as $pdfResource) {
            $pdfsToMerge[] = [
                'type' => 'file',
                'path' => storage_path('app/public/' . $pdfResource->path),
                'order' => $pdfResource->pivot->order,
            ];
        }

        // Incluir el PDF del presupuesto con el orden especificado
        $budgetPdfEntry = DB::table('budget_pdf_resource')
            ->where('budgetable_id', $budget->id)
            // ->where('budgetable_type', Budget::class)
            ->where('pdf_resource_id', 'main_budget_pdf')
            ->first();

        if ($budgetPdfEntry) {
            $pdfsToMerge[] = [
                'type' => 'string',
                'content' => $budgetPdfContent,
                'order' => $budgetPdfEntry->order,
            ];
        } else {
            // Si no se especificó el orden, asignar un orden predeterminado
            $pdfsToMerge[] = [
                'type' => 'string',
                'content' => $budgetPdfContent,
                'order' => 0,
            ];
        }

        // Ordenar los PDFs por 'order'
        usort($pdfsToMerge, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        return $pdfsToMerge;
    }
}
