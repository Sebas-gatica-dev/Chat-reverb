<?php

use App\Http\Controllers\ChatRoomController;
use Illuminate\Support\Facades\Route;
use App\Livewire\ChatRoom;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Route::get('/chat-room', ChatRoom::class)->middleware('auth')->name('chat.room');
  






require __DIR__.'/auth.php';

