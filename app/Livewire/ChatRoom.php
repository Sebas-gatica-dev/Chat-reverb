<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;
use App\Events\GotMessage;
use App\Models\Chat;
use App\Models\Contact;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class ChatRoom extends Component
{

    public $chats;
    public $user;
    public $users;
    public $messages;

    public function mount()
    {

        $this->user = Auth::user();
        $this->users = User::whereNot('id', $this->user->id)->get();
        // $this->chats = Chat::where('user_id', $this->user->id)->get();

        // dd($this->user);
    }


    protected $listeners = ['openChat' => 'openChat'];



    //#[On('echo:chat_on,Chat')]
    public function openChat($id)
    {
        //dd('ChatRoom');
        
        $logued_user = auth()->user();

        $chat_exist = $logued_user->chats()->whereHas('users', function ($q) use ($id) {
            $q->where('id', $id);
        })->first();

        //dd($chat_exist);

        if (!$chat_exist) {

            $chat_exist =  Chat::create();
            $chat_exist->users()->sync([$logued_user->id, $id]);
        }


        //$this->redirectRoute('chat.room', ['chatId' => $id]);
        $this->dispatch('showMessages', $chat_exist->id)->to(ChatComponent::class);
    }


    public function hasMessages($id) : bool
    { 
        $user = User::find($id);
  
        $last_message = $user->messages()->latest()->first(); 

        return $last_message ? true : false;
       
    }


    public function getUserData($id) 
    {

        $user = User::find($id);
  
        $last_message = $user->messages()->latest()->first() ?? false; 

        if($last_message){


            $last_message_date = $last_message->created_at->format('H:i');;        

            return [
               'time_last_mjs' => $last_message_date,
               'text_last_mjs' => $last_message->text
            ];

        }

      

                                
    }



    public function avatarInitials($id) : string
    {

        $exceptions = ["Mr.","Mrs.","Prof.","Miss","Dr."];

        $user = User::find($id);
       
        $name = $user->name;

        $str_arr =  explode(" ", $name);

        if(count($str_arr) == 1){

            $avatarInitials = $str_arr[0][0];

        }elseif(in_array($str_arr[0], $exceptions)){
            $avatarInitials = $str_arr[2][0] ?  $str_arr[1][0] . $str_arr[2][0] : $str_arr[1][0]; 
        }
        else{
           
            $avatarInitials = $str_arr[0][0] . $str_arr[1][0];
        }


        return $avatarInitials;
      

    }


    public function sendMessage() {}

    #[Title('Chat Room')]
    public function render()
    {

        return view('livewire.chat-room', [
            'users' => $this->users,
        ])->layout('layouts.app');
    }
}
