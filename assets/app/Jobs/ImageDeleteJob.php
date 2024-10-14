<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\File;
use Illuminate\Support\Facades\Storage;




class ImageDeleteJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;


    protected ?File $file;
    protected string $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct( File $file, $filePath)
    {
        //
        $this->file = $file;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Eliminar el archivo del almacenamiento si existe
            if (Storage::exists($this->filePath)) {

                Storage::delete($this->filePath);
                Log::info("Archivo eliminado del almacenamiento: {$this->filePath}");
                
            } else {

                Log::warning("El archivo no existe en el almacenamiento: {$this->filePath}");

            }
    
            // Eliminar el registro de la base de datos
            if ($this->file) {
              
                $this->file->forceDelete();
                Log::info("Registro del archivo eliminado correctamente de la base de datos, ID: {$this->file->id}");

            } else {

                Log::warning("El objeto de archivo es nulo o no se encontró en la base de datos.");

            }
        } catch (\Exception $e) {

            Log::error("Error al eliminar archivo o su registro de la base de datos: {$this->filePath}. Error: " . $e->getMessage());
            throw $e;

        }
    }
}
