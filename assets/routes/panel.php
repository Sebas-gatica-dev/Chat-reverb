<?php

use App\Http\Middleware\WithBusiness;
use App\Http\Middleware\WithSubscription;
use App\Livewire\Panel\Budgets\AddBudget;
use App\Livewire\Panel\Business\AddBusiness;
use App\Livewire\Panel\Customers\AddCustomer;
use App\Livewire\Panel\Customers\ListCustomer;
use App\Livewire\Panel\Customers\ShowCustomer;
use App\Livewire\Panel\Dashboard as PanelDashboard;
use App\Livewire\Panel\Leads\AddLead;
use App\Livewire\Panel\Leads\EditLead;
use App\Livewire\Panel\Leads\ListLead;
use App\Livewire\Panel\Property\EditProperty;
use App\Livewire\Panel\Property\AddProperty;
use App\Livewire\Panel\Property\ShowProperty;
use App\Livewire\Panel\Property\Visit\AddVisit;
use App\Livewire\Panel\Property\Visit\EditVisit;
use App\Livewire\Panel\Property\Visit\UpdateStatusVisit;
use App\Livewire\Panel\Routes\CalendarMonthVisit;
use App\Livewire\Panel\Routes\ListRoute;
use App\Livewire\Panel\SearchList;
use App\Livewire\Panel\Settings\BankAccounts\AddBankAccount;
use App\Livewire\Panel\Settings\BankAccounts\EditBankAccount;
use App\Livewire\Panel\Settings\BankAccounts\ListBankAccounts;
use App\Livewire\Panel\Settings\Branches\AddBranch;
use App\Livewire\Panel\Settings\Branches\ListBranches;
use App\Livewire\Panel\Settings\Branches\EditBranch;
use App\Livewire\Panel\Settings\Budgetems\AddBudgetem;
use App\Livewire\Panel\Settings\Budgetems\EditBudgetem;
use App\Livewire\Panel\Settings\Budgetems\ListBudgetem;
use App\Livewire\Panel\Settings\General\UpdateGeneral;
use App\Livewire\Panel\Settings\Products\ProductAdd;
use App\Livewire\Panel\Settings\Products\ProductEdit;
use App\Livewire\Panel\Settings\Products\ProductList;
use App\Livewire\Panel\Settings\PropertiesTypes\ListPropertiesTypes;
use App\Livewire\Panel\Settings\Roles\AddRole;
use App\Livewire\Panel\Settings\Roles\EditRole;
use App\Livewire\Panel\Settings\Roles\ListRoles;
use App\Livewire\Panel\Settings\Services\ListServices;
use App\Livewire\Panel\Settings\Stock\WarehouseAdd;
use App\Livewire\Panel\Settings\Stock\WarehouseEdit;
use App\Livewire\Panel\Settings\Stock\WarehouseList;
use App\Livewire\Panel\Settings\Subscription\ChanguePlan;
use App\Livewire\Panel\Settings\Subscription\MySubscription;
use App\Livewire\Panel\Settings\Users\AddUser;
use App\Livewire\Panel\Settings\Users\EditUser;
use App\Livewire\Panel\Settings\Users\ListUsers;
use App\Livewire\Panel\Settings\VisitsTypes\ListVisitsTypes;
use App\Livewire\Panel\Settings\Zones\ListZones;
use App\Livewire\Panel\Stock\StockInventoryAdd;
use App\Livewire\Panel\Stock\StockInventoryEdit;
use App\Livewire\Panel\Stock\StockInventoryList;
use App\Livewire\Panel\Subscriptions\Payments\PaymentsList;
use App\Livewire\Panel\Subscriptions\PlansList;
use App\Livewire\Panel\Trash;
use App\Livewire\Panel\Visit\Organizer\ListOrganizedRoute;
use App\Livewire\Panel\Visit\Organizer\ShowOrganizerPreview;
use App\Livewire\Panel\Visit\Organizer\TotalOrganizer;
use App\Livewire\Panel\Visit\Organizer\VisitOrganizerPreview;
use Illuminate\Support\Facades\Route;
use App\Livewire\Panel\Stock\StockList;




Route::prefix('panel')->name('panel.')->middleware(['auth', 'verified', 'with-business', 'with-subscription'])->group(function () {

    Route::get('/', PanelDashboard::class)
        ->name('dashboard');

    Route::get('/buscador', SearchList::class)->name('search');
    Route::get('/trash', Trash::class)->name('trash');



    Route::prefix('stock')->name('stock.')->group(function () {
        Route::get('/', StockList::class)->name('list');
        Route::get('{product}/inventario', StockInventoryList::class)->name('inventory-list');
        Route::get('agregar', StockInventoryAdd::class)->name('inventory-add');
        Route::get('{product}/editar', StockInventoryEdit::class)->name('inventory-edit');

    });
    

    //COMIENZO DE DE LAS RUTAS SETTINGS
    Route::prefix('configuracion')->name('settings.')->group(function () {
        Route::prefix('mi-suscripcion')->name('my-subscription.')->group(function () {
            Route::get('/', MySubscription::class)->name('index')->withoutMiddleware('with-subscription');
            Route::get('planes', ChanguePlan::class)->name('changue-plan')->withoutMiddleware('with-subscription');
        });
        Route::prefix('general')->name('general.')->group(function () {
            Route::get('/', UpdateGeneral::class)->name('business');
        });

        // CRUD SUCURSALES
        Route::prefix('sucursales')->name('branches.')->group(function () {
            Route::get('/', ListBranches::class)->name('list');
            Route::get('actualizar/{branch}', EditBranch::class)->name('update');
            Route::get('crear', AddBranch::class)->name('create');
        });
        Route::prefix('tipos-propiedades')->name('properties-types.')->group(function () {
            Route::get('/', ListPropertiesTypes::class)->name('index');
        });
        Route::prefix('tipos-visitas')->name('visits-types.')->group(function () {
            Route::get('/', ListVisitsTypes::class)->name('list');
        });
        Route::prefix('servicios')->name('services.')->group(function () {
            Route::get('/', ListServices::class)->name('list');
        });
        Route::prefix('zonas')->name('zones.')->group(function () {
            Route::get('/', ListZones::class)->name('index');
        });

        Route::prefix('roles')->name('roles.')->group(function () {
            Route::get('/', ListRoles::class)->name('list');
            Route::get('agregar', AddRole::class)->name('create');
            Route::get('{role}/editar', EditRole::class)->name('edit');
        });

        // CRUD USUARIOS

        Route::prefix('usuarios')->name('users.')->group(function () {
            Route::get('/', ListUsers::class)->name('list');
            Route::get('agregar', AddUser::class)->name('create');
            Route::get('{user}/editar', EditUser::class)->name('edit');
        });



        // CRUD CUENTAS BANCARIAS

        Route::prefix('cuentas-bancarias')->name('bank-accounts.')->group(function () {
            Route::get('/', ListBankAccounts::class)->name('list');
            Route::get('agregar', AddBankAccount::class)->name('create');
            Route::get('{bankAccount}/editar', EditBankAccount::class)->name('edit');
        });


        //VARIABLES DE PRESUPUESTO

        Route::prefix('variables-presupuestarias')->name('budgetems.')->group(function () {
            Route::get('/', ListBudgetem::class)->name('list');
            Route::get('agregar', AddBudgetem::class)->name('create');
            Route::get('{budgetem}/editar', EditBudgetem::class)->name('edit');
        });




        //modulo de stock


    Route::prefix('stock')->name('stock.')->group(function () {


        Route::get('/', StockList::class)->name('list');


        //settings
        Route::prefix('depositos')->name('warehouse.')->group(function () {
            Route::get('/', WarehouseList::class)->name('list');
            Route::get('agregar', WarehouseAdd::class)->name('create');
            Route::get('{warehouse}/editar', WarehouseEdit::class)->name('edit');
        });
        Route::prefix('productos')->name('product.')->group(function () {
            Route::get('/', ProductList::class)->name('list');
            Route::get('agregar', ProductAdd::class)->name('create');
            Route::get('{product}/editar', ProductEdit::class)->name('edit');
        });

        //end settings
    });



    });


    Route::prefix('primeros-pasos')->name('first-steps.')->middleware('first-steps-subscription')->group(function () {
        Route::get('empresa', AddBusiness::class)->name('business')->withoutMiddleware(['with-business', 'with-subscription']);
        Route::get('plan', PlansList::class)->name('plan')->withoutMiddleware('with-subscription');
    });


    Route::prefix('clientes')->name('customers.')->group(function () {
        Route::get('/', ListCustomer::class)->name('list');
        Route::get('agregar', AddCustomer::class)->name('add');
        Route::get('{customer}', ShowCustomer::class)->name('show');
        Route::get('{customer}/propiedad/agregar', AddProperty::class)->name('property.add');
        Route::get('{customer}/propiedad/{property}', ShowProperty::class)->name('property.show');
        Route::get('{customer}/propiedad/{property}/editar', EditProperty::class)->name('property.edit');

        //Visitas
        Route::get('{customer}/propiedad/{property}/agregar-visita', AddVisit::class)->name('property.visit.add');
        Route::get('{customer}/propiedad/{property}/visita/{visit}', EditVisit::class)->name('property.visit.edit');

        Route::get('{customer}/propiedad/{property}/visita/{visit}/actualizar-estado', UpdateStatusVisit::class)->name('property.visit.update.status');
    });

    Route::prefix('rutas')->name('routes.')->group(function () {
        //  Route::get('/', CalendarMonthVisit::class)->name('list');
        Route::get('organizar-visitas', TotalOrganizer::class)->name('organizer');

        //preview de rutas

        Route::get('organizar-visitas/lista-de-rutas-organizadas', ListOrganizedRoute::class)->name('list');

        Route::get('organizar-visitas/lista-de-rutas-organizadas/{routeId}', ShowOrganizerPreview::class)->name('preview');

        // Route::get('organizar-visitas/preview', VisitOrganizerPreview::class)->name('organizer.preview');



        // Route::get('{year}', ListRoute::class)->name('anual'); // formato calendario anual
        Route::get('{year}/{month}', CalendarMonthVisit::class)->name('monthly'); // formato calendario del mes
        Route::get('{year}/{month}/{day}', ListRoute::class)->name('daily'); //formato lista
    });



    //Modulo de leads
    Route::prefix('clientes-potenciales')->name('leads.')->group(function () {

        Route::get('/', ListLead::class)->name('list');
        Route::get('agregar', AddLead::class)->name('add');
        Route::get('editar/{lead}', EditLead::class)->name('edit');
    });



    //Modulo de presupuesto

    Route::prefix('presupuesto')->name('budget.')->group(function () {
        Route::get('crear/{lead}', AddBudget::class)->name('add');
    });



    Route::prefix('empresa')->name('business.')->group(function () {});

    Route::prefix('estado-pago')->name('payment-status.')->group(function () {
        Route::get('success', function () {
            return 'success';
        })->name('success');
        Route::get('rejected', function () {
            return 'rejected';
        })->name('rejected');
    });




    


});
