<?php

use App\Livewire\Panel\Customers\AddCustomer;
use App\Livewire\Panel\Customers\CustomersList;
use App\Livewire\Panel\Customers\ShowCustomer;
use App\Livewire\Panel\Dashboard as PanelDashboard;
use Illuminate\Support\Facades\Route;



Route::get('/', function(){
    return redirect()->route('panel.dashboard');
})->name('index');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
