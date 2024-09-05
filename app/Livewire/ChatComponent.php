<?php

namespace App\Livewire;

use App\Models\Chat;
use App\Models\Message;
use Livewire\Attributes\On;
use Livewire\Component;
use PhpParser\Node\Scalar\DNumber;
use Livewire\WithFileUploads;
use App\Events\Chat as ChatOn;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Url;

class ChatComponent extends Component
{
   use WithFileUploads;

   #[Url()]
  public $chatId;
  public $messageInput = '';
  public $messages;
  public $user_logued;

  public $image;

public Chat $chatMessages;




  public function mount()
  {

    $this->user_logued = auth()->user();

    $this->initialChat();




    // dd($this->messages);
  }


  public function initialChat(){
    
    if($this->chatId){

      $chatActual = Chat::where('id', $this->chatId)->first();
      $this->openChat($chatActual);


    }else{

      return;
    }

  }

  #[On('showMessages')]
  public function openChat(Chat $chat)
  {



   //dd('Chat component');
    $this->chatMessages = $chat;



    $this->chatId = $chat->id;
    $this->messages = $chat->messages;

    // $cached_chatId = Cache::get('chatId');

    // if(!$cached_chatId){

    //   Cache::put('chatId', $this->$chat->id);

    // }



    // dd($this->messages);

  }


  // #[On('echo:chats.{chatId},Chat')]
  #[On('RefreshMessages')]
  public function showMessages(){

    $this->messages = $this->chatMessages->messages;
  }


  public function validateMessageOwner($id): bool
  {
    if ($this->user_logued->id == $id) {

      return true;
    }

    return false;
  }




  public function sendMessage(){

//dd('asdas');
  // $this->validate([
  //     'image' => 'image|max:1024',
  // ]);

  if($this->image){
    $this->image->store('images');


  }
    ChatOn::dispatch($this->chatId,$this->messageInput);

  //  dd($this->image);

    Message::create([
      'user_id' => $this->user_logued->id,
      'text' => $this->messageInput,
      'chat_id' => $this->chatId,
      'path' => $this->image ? 'images/'. $this->image->hashName() : null,
    ]);

    // dd('test');

    //$this->dispatch('showMessages', )
    //  $this->messageInput = '';
     $this->reset('messageInput');
     $this->reset('image');

     $this->showMessages();
    //  $this->render();
    //  $this->reset();
    // return $this->redirect('/posts');
  }


  public function updateMessage(Message $update_message){
      $update_message->update([
        'text' => $this->messageInput
      ]);
  }



  public function deleteMessage(Message $delete_message){

    $delete_message->delete();
    $this->render();
  }



  public function render()
  {
    return view('livewire.chat-component', [
      'messages' => $this->messages
    ]);
  }
}


