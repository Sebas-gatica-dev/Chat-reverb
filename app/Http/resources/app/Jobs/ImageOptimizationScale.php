<?php

namespace App\Jobs;

use App\Enums\FileTypeEnum;
use App\Models\File;
use Intervention\Image\ImageManager;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Gd\Driver;


class ImageOptimizationScale implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $filename;
    protected $fileModel;
    protected $height;
    protected $width;
    /**
     * Create a new job instance.
     *
     * @param string $filename
     * @param $fileSaved
     */
    public function __construct($filename, $fileModel, $height = 600, $width = null)
    {
        $this->filename = $filename;
        $this->fileModel = $fileModel;
        $this->height = $height;
        $this->width = $width;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {


        //Obtenemos el path completo del archivo a optimizar
        $filePath = storage_path('app/public/' . $this->filename);





        if (file_exists($filePath)) {
            $manager = new ImageManager(new Driver());

            //SI RECIBO EL WIDTH Y HEIGHT VA A COMPORTARSE COMO SQUARE
            if ($this->width && $this->height) {

                $uploadFile = $manager->read($filePath)
                    ->coverDown($this->width, $this->height, 'center')
                    ->toWebp(60);

                // CASO CONTRARIO COTINUCA CON EL SCALE
            } else {

                $uploadFile = $manager->read($filePath)
                    ->scaleDown(height: $this->height)
                    ->toWebp(60);
            }



            //Obtenemos la información del archivo
            $fileInfo = pathinfo($filePath);

            //Creamos la ruta de un nuevo archivo con la extensión webp
            $newFilePath = $fileInfo['dirname'] . '/' . uniqid() . '.webp';

            //Guardamos el archivo optimizado
            $relativeFilePath = str_replace(storage_path('app/public/'), '', $newFilePath);

            //Guardamos el archivo optimizado en el storage
            Storage::put($relativeFilePath, (string) $uploadFile);

            //Obtenemos el tamaño del archivo optimizado
            $size = Storage::size($relativeFilePath);

            $name = pathinfo($relativeFilePath, PATHINFO_BASENAME);

            $extension = pathinfo($relativeFilePath, PATHINFO_EXTENSION);

            //Actualizamos la propiedad con la ruta del archivo optimizado
            Storage::delete($this->filename);

            // Crear la foto en la base de datos
            $this->fileModel->update([

                // 'name' => $name,
                'path' => $relativeFilePath,
                'size' => $size,
                'type' =>  FileTypeEnum::getTypeForExtension($extension),

            ]);
        }
    }
}
