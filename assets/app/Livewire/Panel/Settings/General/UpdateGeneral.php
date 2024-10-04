<?php

namespace App\Livewire\Panel\Settings\General;

use App\Helpers\Notifications;
use App\Models\Business;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Support\Str;
use App\Traits\ValidateNotificationTrait;


class UpdateGeneral extends Component
{
    use WithFileUploads, ValidateNotificationTrait;

    public Business $business;
    public $name;
    public $phone;
    public $email;

    public $logo = [];

    public bool $updateName = false;
    public bool $updateAddress = false;
    public bool $updatePhone = false;
    public bool $updateEmail = false;

    public $updateLogo = false;


    public function mount()
    {
        $this->authorize('access-function', 'business-general-show');
        $this->business = auth()->user()->business;
        $this->name = $this->business->name;
        $this->phone = $this->business->phone;
        $this->email = $this->business->email;
        $this->logo[] = $this->business->logo;
    }

    public function updateNameBusiness()
    {
        $this->validate([
            'name' => 'required|string|max:255'
        ]);

        $this->business->update([
            'name' => $this->name
        ]);

        $this->updateName = false;

        $this->dispatch('notification', [
            'message' => 'Negocio actualizado correctamente',
            'type' => Notifications::icons('success')
        ]);
    }

    // public function updateAddressBusiness()
    // {
    //     $this->validate([
    //         'address' => 'required|string|max:255'
    //     ]);

    //     $this->business->update([
    //         'address' => $this->address
    //     ]);

    //     $this->updateAddress = false;

    //     $this->dispatch('notification', [
    //         'message' => 'Negocio actualizado correctamente',
    //         'type' => Notifications::icons('success')
    //     ]);
    // }

    public function updatePhoneBusiness()
    {
        $this->validate([
            'phone' => 'required|string|max:255'
        ]);

        $this->business->update([
            'phone' => $this->phone
        ]);

        $this->updatePhone = false;

        $this->dispatch('notification', [
            'message' => 'Negocio actualizado correctamente',
            'type' => Notifications::icons('success')
        ]);
    }

    public function updateEmailBusiness()
    {
        $this->validate([
            'email' => 'required|email'
        ]);

        $this->business->update([
            'email' => $this->email
        ]);

        $this->updateEmail = false;

        $this->dispatch('notification', [
            'message' => 'Negocio actualizado correctamente',
            'type' => Notifications::icons('success')
        ]);
    }

    //Update Logo
    public function updateLogoBusiness()
    {

        if ($this->logo instanceof TemporaryUploadedFile) {

            if ($this->business->getRawOriginal('logo')) {
                Storage::delete($this->business->getRawOriginal('logo'));
            }

            $manager = new ImageManager(new Driver());

            // Redimensionar y optimizar la imagen
            $image = $manager->read($this->logo->getRealPath())
                ->coverDown(500, 500, 'center')->toWebp(60);
            // Crear un nombre único para la imagen
            $filename =  Str::slug($this->business->name) . '/logos/' . $this->business->id . '/' . uniqid() . '.webp';
            // Guardar la imagen optimizada en el storage

            Storage::put($filename, $image);
            // Actualizar la propiedad con la ruta de la imagen optimizada
            $this->business->update([
                'logo' => $filename
            ]);

        }else{

            if (!$this->logo && $this->business->getRawOriginal('logo')) {
                Storage::delete($this->business->getRawOriginal('logo'));
                $this->business->update([
                    'logo' => null
                ]);

            }
        }

        $this->logo = [];
        $this->logo [] = $this->business->logo;
        $this->updateLogo = false;
        $this->dispatch('notification', [
            'message' => 'Negocio actualizado correctamente',
            'type' => Notifications::icons('success')
        ]); 
               
    }


    #[On('change-files-general-logo')]
    public function changeLogo($value)
    {

        $file = TemporaryUploadedFile::unserializeFromLivewireRequest($value);
        $this->logo = $file;
    }

    #[On('remove-files-general-logo')]
    public function removeLogo()
    {

        $this->logo = null;
    }

    #[On('remove-files-existing-general-logo')]
    public function removePhotoExisting()
    {
        $this->logo = null;
    }


    //Preview Logo / Despues de seleccionar el logo se muestra la vista previa
    // public function updatedLogo()
    // {
    //     $this->validate([
    //         'logo' => 'image|max:15000|required'
    //     ]);
    //     $this->logoPreview = $this->logo[0]->temporaryUrl();

    //     $this->dispatch('notifications', [
    //         'message' => 'Negocio actualizado correctamente',
    //         'type' => Notifications::icons('success')
    //     ]);
    // }


    public function render()
    {
        return view('livewire.panel.settings.general.update-general')
            ->layout('layouts.panel', ['title' => 'Update General Settings']);
    }
}
