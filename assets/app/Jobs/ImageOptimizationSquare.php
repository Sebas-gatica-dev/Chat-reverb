<?php

namespace App\Jobs;

use App\Models\File;
use Intervention\Image\ImageManager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Gd\Driver;

class ImageOptimizationSquare implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $filename;
    protected File $fileSaved;
    /**
     * Create a new job instance.
     * @param string $filename
     * 
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
       
    }
    

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
           
        // Obtener la imagen del almacenamiento
        $filePath = storage_path('app/public/' . $this->filename);

        // Log::info('mis variables del job',[
        //     'filepath' => $filePath, 
        //     'filename' => $this->filename, 
        //     'filesaved' => $this->fileSaved
        // ]);
        
        if (file_exists($filePath)) {
            $manager = new ImageManager(new Driver());
            $uploadFile = $manager->read($filePath)
                ->coverDown(500, 500, 'center')
                ->toWebp(60);

            // Reemplazar el archivo original con la versión optimizada
           Storage::put($this->filename, $uploadFile);
           
            // Actualizar la base de datos con la nueva ruta de la imagen

        
            // Log::info('manager y kuypload file',[
            //     'manager' => $manager,
            //     'uploadFile' => $uploadFile
            // ]);

        }


    }
}
