<?php

use App\Livewire\Master\Businesses\ListBusiness;
use App\Livewire\Master\Businesses\AddBusiness;
use App\Livewire\Master\Businesses\EditBusiness;
use App\Livewire\Master\Features\AddFeature;
use App\Livewire\Master\Features\EditFeature;
use App\Livewire\Master\Industries\AddIndustry;
use App\Livewire\Master\Industries\EditIndustry;
use App\Livewire\Master\Industries\ListIndustry;
use App\Livewire\Master\MasterDashboard;
use App\Livewire\Master\Modules\AddModule;
use App\Livewire\Master\Modules\EditModule;
use App\Livewire\Master\Modules\ListModule;
use App\Livewire\Master\Plans\AddPlan;
use App\Livewire\Master\Plans\EditPlan;
use App\Livewire\Master\Plans\ListPlan;
use App\Livewire\Master\Roles\AddRole;
use App\Livewire\Master\Roles\EditRole;
use App\Livewire\Master\Roles\ListRoles;
use Illuminate\Support\Facades\Route;


Route::prefix('master')->name('master.')->middleware(['auth', 'verified'])->group(function () {

    //Dashboard
    Route::get('/', MasterDashboard::class)->name('dashboard');


    //Planes
    Route::prefix('planes')->name('plans.')->group(function () {
        Route::get('/', ListPlan::class)->name('index');
        Route::get('agregar', AddPlan::class)->name('create');
        Route::get('editar/{plan}', EditPlan::class)->name('edit');
    });

    //Modulos

    Route::prefix('modulos')->name('modules.')->group(function () {
        Route::get('/', ListModule::class)->name('index');

        Route::get('agregar',AddModule::class)->name('create');
        Route::get('editar/{module}', EditModule::class)->name('edit');

        Route::get('{module}/agregar-funcion',AddFeature::class)->name('feature.create');
        Route::get('{module}/editar-funcion/{feature}', EditFeature::class)->name('feature.edit');


    });
    //Negocios
    Route::prefix('negocios')->name('businesses.')->group(function () {
        Route::get('/', ListBusiness::class)->name('index');

        Route::get('agregar',AddBusiness::class)->name('create');
        Route::get('editar/{business}', EditBusiness::class)->name('edit');
    });


    //Industrias
    Route::prefix('industria')->name('industries.')->group(function () {
        Route::get('/', ListIndustry::class)->name('index');
        Route::get('agregar', AddIndustry::class)->name('create');
        Route::get('editar/{industry}', EditIndustry::class)->name('edit');

    });

   //Roles
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', ListRoles::class)->name('index');
        Route::get('agregar', AddRole::class)->name('create');
        Route::get('editar/{role}', EditRole::class)->name('edit');
    });


});
