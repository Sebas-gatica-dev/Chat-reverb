<?php

namespace App\Livewire\Panel\Property\Visit;

use App\Helpers\Notifications;
use App\Models\File;
use Illuminate\Support\Facades\Bus;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Jobs\ImageOptimizationScale;
use App\Jobs\ImageDeleteJob;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class AddComment extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $visit;
    public $isOpen = false;
    public $perPage = 4;
    public $message;
    public $editMessage;
    public $editCommentModel;
    public $editCommentSuccess = false;
    public $files = [];
    public $editFiles = [];
    public $newFiles = [];

    public $principalComment;
    public function validationAttributes()
    {
        return [
            'editMessage' => 'mensaje',
        ];
    }
    public function mount($visit)
    {
        $this->authorize('access-function', 'visit-comment-add');
        $this->visit = $visit;
    }

    public function loadComments()
    {
        $this->isOpen = true;
    }

    public function addComment()
    {
        $this->validate([
            'message' => 'required|min:20',
            'files.*' => 'required|max:15360'
        ]);

        $comment = $this->visit->comments()->create([
            'message' => $this->message,
            'user_id' => auth()->id(),
        ]);

        if (is_array($this->files)) {
            foreach ($this->files as $file) {


                if (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'webp', 'bmp', 'svg', 'tiff'])) {

                $filePath = Str::slug(auth()->user()->business->name) . '/comments/' . $comment->id . '/files/';
                $filename = uniqid() . '.' . $file->extension();
                $filenameComplete = $filePath . $filename;



                 // Guarda el archivo
                $file->storeAs($filePath, $filename);

                // dd($file->getClientOriginalName());

                //loop en el nombre
               $fileSaved =   $comment->files()->create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $filenameComplete,
                    'size' => $file->getSize(),
                    'type' => $file->extension(),
                    'user_id' => auth()->id(),
                ]);

                Bus::dispatchSync(new ImageOptimizationScale($filenameComplete, $fileSaved)); 

            }else{


                $filename =  Str::slug(auth()->user()->business->name) . '/comments/' . $comment->id . '/' . '/files/' . uniqid() . '.' . $file->extension();
                $uploadFile = $file->getRealPath();
                Storage::put($filename, file_get_contents($uploadFile));


                $fileSaved =   $comment->files()->create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $file->store('files'),
                    'size' => $file->getSize(),
                    'type' => $file->extension(),
                    'user_id' => auth()->id(),
                ]);
          

            
            }




            }
        }




        $this->dispatch('notification', [
            'message' => 'Comentario agregado correctamente',
            'type' => Notifications::icons('success')
        ]);

        $this->reset('message', 'files');
    }



    public function updatedEditFiles()
    {
        if (is_array($this->editFiles)) {

            $this->validate([
                'editFiles.*' => 'max:15360'
            ]);

            foreach ($this->editFiles as $file) {

                if (in_array($file->extension(), ['jpg', 'jpeg', 'png', 'webp', 'bmp', 'svg', 'tiff'])) {


                $filePath = Str::slug(auth()->user()->business->name) . '/comments/' . $this->editCommentModel->id . '/files/';
                $filename = uniqid() . '.' . $file->extension();
                $filenameComplete = $filePath . $filename;
                
                $file->storeAs($filePath, $filename);


              $fileSaved =   $this->editCommentModel->files()->create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $filenameComplete,
                    'size' => $file->getSize(),
                    'type' => $file->extension(),
                    'user_id' => auth()->id(),
                ]);

                

              Bus::dispatchSync(new ImageOptimizationScale($filenameComplete, $fileSaved));



            }else{


                $this->editCommentModel->files()->create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $file->store('files'),
                    'size' => $file->getSize(),
                    'type' => $file->extension(),
                    'user_id' => auth()->id(),
                ]);

            }
        }

        $this->dispatch('notification', [
            'message' => 'Archivos subidos correctamente',
            'type' => Notifications::icons('success')
        ]);
    }
}


    public function editComment($id)
    {
        $this->resetValidation(['editMessage']);
        $this->editMessage = '';
        $this->editCommentSuccess = false;


        $comment = $this->visit->comments()->find($id);

        if ($comment) {
            $this->editMessage = $comment->message;
            $this->editCommentModel = $comment;
        }


    }

    
    public function updateComment($id)
    {

        $this->validate([
            'editMessage' => 'required|min:20'
        ]);

        $this->editCommentModel->message = $this->editMessage;
        $this->editCommentModel->save();


        $this->editCommentSuccess = true;

        $this->dispatch('notification', [
            'message' => 'Comentario editado correctamente',
            'type' => Notifications::icons('success')
        ]);

        $this->reset('editMessage');
    }


    public function removeFile($index)
    {
        $file = $this->files[$index];

        // Verifica que sea una instancia de Livewire\TemporaryUploadedFile
        if ($file instanceof \Livewire\TemporaryUploadedFile) {
            // Elimina el archivo del directorio temporal
            $file->delete();
        }
    
        // Elimina el archivo del array
        unset($this->files[$index]);

    }

    public function updatedNewFiles()
    {
        // dd($this->files, $this->newFiles);
        $this->files = array_merge($this->files, $this->newFiles);
        $this->newFiles = [];

    }

    public function removeFileComment($id)
    {
        $file = File::find($id);
        if ($file) {
            $filePath = $file->getRawOriginal('path');
            Bus::dispatch(new ImageDeleteJob($file, $filePath));
            $file->delete();
        }

        $this->dispatch('notification', [
            'message' => 'Archivo eliminado correctamente',
            'type' => Notifications::icons('success')
        ]);
    }


    public function removeComment($id)
    {
        $comment = $this->visit->comments()->find($id);


        $files = $comment->files;


        foreach($files as $file){
            $filePath = $file->getRawOriginal('path');
            Bus::dispatch(new ImageDeleteJob($file, $filePath));
            $file->delete();
        }

        

        if ($comment) {
            $comment->delete();
        }

        $this->dispatch('notification', [
            'message' => 'Comentario eliminado correctamente',
            'type' => Notifications::icons('success')
        ]);
    }

    public function render()
    {
        $comments = $this->visit->paginatedComments($this->perPage, $this->principalComment);


        return view('livewire.panel.property.visit.add-comment', [
            'comments' => $comments,
        ]);
    }

    public function loadMore()
    {
        $this->perPage += 4;
    }
}
