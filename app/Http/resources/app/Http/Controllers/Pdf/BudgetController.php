<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use function Spatie\LaravelPdf\Support\pdf;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class BudgetController extends Controller
{
    public function __invoke(Budget $budget)
    {

        //Variables publicas para el pdf
        if(!File::exists(storage_path('tmp'))){
            File::makeDirectory(storage_path('tmp'), 0775, true);
        }


        $budgetItems = $budget->publicVisibleBudgetems;

        $business = $budget->business;

        $budgetInvisibleItems = $budget->publicInvisibleBudgetems;

        //Sumar $budgetInvisibleItems 
        $totalBudgetInvisibleItems = 0;
        foreach ($budgetInvisibleItems as $item) {
            $totalBudgetInvisibleItems += $item->pivot->total;
        }

        // Obtener el cliente asociado al presupuesto (puede ser Lead o Customer)
        $budgetable = $budget->budgetable;

        // Crear el nombre del archivo PDF basado en el nombre del cliente
        $pdfFileName = 'presupuesto-' . $budgetable->id . '.pdf';

        // Crear la estructura de directorios usando el slug del nombre del negocio
        $businessSlug = Str::slug(auth()->user()->business->name);


        // Definir la ruta donde se almacenará el PDF en el storage
        $pdfFilePath =  '/' . $businessSlug . '/budgets/' . $pdfFileName;


          // Verificar si el directorio de presupuestos no existe
         if(!Storage::exists($businessSlug . '/budgets/')){

            // Crear el directorio de presupuestos
            Storage::makeDirectory($businessSlug . '/budgets/');

         }

        // Verificar si el archivo ya existe en el storage
        if (Storage::exists($pdfFilePath)) {
            // Si el archivo ya existe, devolver el PDF guardado
            return response()->file(storage_path('app/public' . $pdfFilePath));
        }


        // dd($business->logo);
        $pdf = pdf()
            ->view('pdf.budget', [
                'budget' => $budget,
                'lead' => $budgetable, // Cliente (Lead o Customer)
                'budgetItems' => $budgetItems, // Items del presupuesto
                'totalBudgetInvisibleItems' => $totalBudgetInvisibleItems, // Suma de items invisibles
                'business' => $business
            ]);
        // ->disk('public')
        // ->save($pdfFilePath);  // Generar el PDF en memoria
        $pdfContent = $pdf->getBrowsershot()->pdf();


        // Initialize the PDF merger
        $pdfMerger = PDFMerger::init();
        // Get the ordered list of PDFs to merge, including the budget PDF
        $pdfsToMerge = $this->getPdfsToMerge($budget, $pdfContent);
        

        // Add PDFs to the merger in the specified order
        foreach ($pdfsToMerge as $pdf) {
            if ($pdf['type'] === 'string') {
                $pdfMerger->addString($pdf['content'], 'all');
            } elseif ($pdf['type'] === 'file') {
                $pdfMerger->addPDF($pdf['path'], 'all');
            }
        }

       // dd($pdfsToMerge);
        // Merge the PDFs
        $pdfMerger->merge();

        // if(Storage::directories() )
    
        

        // Save the merged PDF to storage
        $pdfMerger->save(storage_path('app/public' . $pdfFilePath));

        // Devolver el archivo guardado para que el usuario lo visualice
        return response()->file(storage_path('app/public' . $pdfFilePath));
    }



    private function getPdfsToMerge(Budget $budget, $budgetPdfContent)
    {
        // Initialize the array with the budget PDF
        $pdfsToMerge = [];

        // Fetch associated PDF resources with their order, including the budget PDF
        $pdfResources = $budget->pdfResources()->withPivot('order')->get();

        // Add PDF resources and the budget PDF to the array
        foreach ($pdfResources as $pdfResource) {
            $pdfsToMerge[] = [
                'type' => 'file',
                'path' => storage_path('app/public/' . $pdfResource->path),
                'order' => $pdfResource->pivot->order,
            ];
        }

        // Include the budget PDF with the specified order
        // Assuming you have stored the order of the budget PDF in a variable or database
        // For this example, let's assume the budget PDF has an order stored in $budgetPdfOrder
        // You need to retrieve this order from where you have stored it

        // For now, let's assume the budget PDF order is stored in the pivot table with a special ID
        $budgetPdfEntry = DB::table('budget_pdf_resource')
            ->where('budgetable_id', $budget->id)
            ->where('pdf_resource_id', 'main_budget_pdf')
            ->first();

        if ($budgetPdfEntry) {
            $pdfsToMerge[] = [
                'type' => 'string',
                'content' => $budgetPdfContent,
                'order' => $budgetPdfEntry->order,
            ];
        } else {
            // If the budget PDF is not specified in order, add it with default order
            $pdfsToMerge[] = [
                'type' => 'string',
                'content' => $budgetPdfContent,
                'order' => 0,
            ];
        }

        // Sort the PDFs by 'order'
        usort($pdfsToMerge, function ($a, $b) {
            return $a['order'] <=> $b['order'];
        });

        return $pdfsToMerge;
    }

    
    public function update(Budget $budget)
    {
       
        // Define the file path and name
        $businessSlug = Str::slug(auth()->user()->business->name);
        $pdfFileName = 'presupuesto-' . $budget->budgetable->name . '.pdf';
        $pdfFilePath = '/' . $businessSlug . '/budgets/' . $pdfFileName;
    
        // Delete the existing merged PDF if it exists
        if (Storage::exists($pdfFilePath)) {
            Storage::delete($pdfFilePath);
        }
    
        // Generate and merge PDFs as in the __invoke method
        return $this->__invoke($budget);
    }





    // // Método para actualizar el Budget y el PDF
    // public function update(Budget $budget)
    // {

    //     // Obtener el cliente asociado al presupuesto (puede ser Lead o Customer)
    //     $budgetable = $budget->budgetable;
    //     // Obtener el nombre del archivo PDF existente
    //     $businessSlug = Str::slug(auth()->user()->business->name);
    //     $pdfFileName = 'presupuesto-' . $budgetable->name . '.pdf';
    //     $pdfFilePath =  '/' . $businessSlug . '/budgets/' . $pdfFileName;

    //     // Eliminar el archivo PDF existente si ya está en el storage
    //     if (Storage::exists($pdfFilePath)) {
    //         // dd('existe');
    //         Storage::delete($pdfFilePath);
    //         // dd($pdfFilePath, $pdfFileName);
    //     }

    //     // Generar un nuevo PDF actualizado
    //     $business = $budget->business;
    //     $budgetItems = $budget->publicVisibleBudgetems;
    //     $budgetInvisibleItems = $budget->publicInvisibleBudgetems;



    //     $totalBudgetInvisibleItems = 0;
    //     foreach ($budgetInvisibleItems as $item) {
    //         $totalBudgetInvisibleItems += $item->pivot->total;
    //     }

    //     $pdf = pdf()
    //         ->view('pdf.budget', [
    //             'budget' => $budget,
    //             'lead' => $budgetable, // Cliente (Lead o Customer)
    //             'budgetItems' => $budgetItems, // Items del presupuesto
    //             'totalBudgetInvisibleItems' => $totalBudgetInvisibleItems, // Suma de items invisibles
    //             'business' => $business
    //         ])
    //         ->name($pdfFileName)
    //         ->disk('public')
    //         ->save($pdfFilePath);  // Generar el PDF en memoria

    //     // // Guardar el nuevo PDF
    //     // Storage::put($pdfFilePath, $pdf);
    //     // return redirect()->back();
    //     // // Devolver el nuevo archivo PDF actualizado
    //     return response()->file(storage_path('app/public' . $pdfFilePath));
    // }


}
