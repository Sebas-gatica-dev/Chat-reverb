<?php
namespace App\Traits;

use App\Helpers\Notifications;
use Illuminate\Validation\ValidationException;


trait ValidateNotificationTrait{

    public function exception($e, $stopPropagation) {
        if($e instanceof ValidationException) {

            $errors = $e->validator->errors()->toArray();
            $errorCount = count($errors);


            if ($errorCount === 1) {
                // Si solo hay un error, mostrar el mensaje completo
                $firstErrorKey = array_key_first($errors);
                $message = $errors[$firstErrorKey][0]; // Obtener el primer error de ese campo
        
                // Enviar el mensaje al frontend usando el evento `notification`
                $this->dispatch('notification', [
                    'message' => $message,
                    'type' => Notifications::icons('error')
                ]);
            } elseif ($errorCount > 1) {
                // Si hay más de un error, mostrar un mensaje general
                $this->dispatch('notification', [
                    'message' => "Tienes $errorCount errores en el formulario.",
                    'type' => Notifications::icons('error')
                ]);
            }

            $stopPropagation();
        }
    }




}




