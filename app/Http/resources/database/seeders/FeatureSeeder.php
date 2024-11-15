<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $dashboard = Module::where('slug', 'dashboard')->firstOrFail();
        $search_main = Module::where('slug', 'search-main')->firstOrFail();
        $customers = Module::where('slug', 'customers')->firstOrFail();
        $property = Module::where('slug', 'properties')->firstOrFail();
        $phones = Module::where('slug', 'phones')->firstOrFail();
        $services = Module::where('slug', 'services')->firstOrFail();
        $zones = Module::where('slug', 'zones')->firstOrFail();
        $bank_accounts = Module::where('slug', 'bank-accounts')->firstOrFail();
        $visit_types = Module::where('slug', 'visit-types')->firstOrFail();
        $property_types = Module::where('slug', 'property-types')->firstOrFail();
        $users = Module::where('slug', 'users')->firstOrFail();
        $roles = Module::where('slug', 'roles')->firstOrFail();
        $subscriptions = Module::where('slug', 'subscriptions')->firstOrFail();
        $branches = Module::where('slug', 'branches')->firstOrFail();
        $visits = Module::where('slug', 'visits')->firstOrFail();
        $settings = Module::where('slug', 'settings')->firstOrFail();
        $trash = Module::where('slug', 'trash')->firstOrFail();
        $leads = Module::where('slug', 'leads')->firstOrFail();
        $business = Module::where('slug', 'business')->firstOrFail();
        $budgets = Module::where('slug', 'budgets')->firstOrFail();
        $stock = Module::where('slug', 'stock')->firstOrFail();
        $budgets = Module::where('slug', 'budgets')->firstOrFail();


        //comienzo de search dashboard

        Feature::create([
            'name' => 'Acceder al Panel de Control',
            'slug' => Str::slug('dashboard-show'),
            'description' => 'Permite el acceso al panel de control principal.',
            'module_id' => $dashboard->id
        ]);

        //fin de search dashboard

        //comienzo de business features

        Feature::create([
            'name' => 'Acceder a la información general de la empresa',
            'slug' => Str::slug('business-general-show'),
            'description' => 'Permite acceder al módulo general de la empresa.',
            'module_id' => $business->id
        ]);
        Feature::create([
            'name' => 'Editar información de la empresa',
            'slug' => Str::slug('business-general-edit'),
            'description' => 'Permite editar los datos de la empresa.',
            'module_id' => $business->id
        ]);

        //fin de business features

        //comienzo de search features

        Feature::create([
            'name' => 'Utilizar el buscador general',
            'slug' => Str::slug('search-main'),
            'description' => 'Permite utilizar el buscador general de la aplicación.',
            'module_id' => $search_main->id
        ]);

        //fin de search features

        //comienzo de customers features

        Feature::create([
            'name' => 'Visualizar lista de clientes',
            'slug' => Str::slug('customer-list'),
            'description' => 'Permite ver la lista completa de clientes.',
            'module_id' => $customers->id
        ]);
        Feature::create([
            'name' => 'Agregar un nuevo cliente',
            'slug' => Str::slug('customer-add'),
            'description' => 'Permite añadir un nuevo cliente al sistema.',
            'module_id' => $customers->id
        ]);
        Feature::create([
            'name' => 'Mostrar detalles de un cliente',
            'slug' => Str::slug('customer-show'),
            'description' => 'Permite ver la información detallada de un cliente.',
            'module_id' => $customers->id
        ]);
        Feature::create([
            'name' => 'Editar información de un cliente',
            'slug' => Str::slug('customer-edit'),
            'description' => 'Permite modificar los datos de un cliente existente.',
            'module_id' => $customers->id
        ]);
        Feature::create([
            'name' => 'Filtrar clientes',
            'slug' => Str::slug('customer-show-filters'),
            'description' => 'Permite aplicar filtros a la lista de clientes.',
            'module_id' => $customers->id
        ]);

        //fin de customers features

        //comienzo de property features

        Feature::create([
            'name' => 'Agregar una propiedad',
            'slug' => Str::slug('property-add'),
            'description' => 'Permite añadir una nueva propiedad al sistema.',
            'module_id' => $property->id
        ]);
        Feature::create([
            'name' => 'Mostrar detalles de una propiedad',
            'slug' => Str::slug('property-show'),
            'description' => 'Permite visualizar la información de una propiedad.',
            'module_id' => $property->id
        ]);
        Feature::create([
            'name' => 'Editar información de una propiedad',
            'slug' => Str::slug('property-edit'),
            'description' => 'Permite modificar los datos de una propiedad.',
            'module_id' => $property->id
        ]);
        Feature::create([
            'name' => 'Desactivar una propiedad',
            'slug' => Str::slug('property-soft'),
            'description' => 'Permite desactivar una propiedad del sistema.',
            'module_id' => $property->id
        ]);
        Feature::create([
            'name' => 'Eliminar una propiedad',
            'slug' => Str::slug('property-delete'),
            'description' => 'Permite eliminar una propiedad de forma permanente.',
            'module_id' => $property->id
        ]);

        // HASTA AQUI

        Feature::create([
            'name' => 'Ver cantidad de días de atraso en las visitas',
            'slug' => Str::slug('property-show-extra-data'),
            'description' => 'Permite visualizar información adicional sobre la propiedad.',
            'module_id' => $property->id
        ]);
        Feature::create([
            'name' => "Visualizar lista de archivos adjuntos a la propiedad",
            'slug' => Str::slug('property-file-list'),
            'description' => 'Permite ver los archivos adjuntos a la propiedad.',
            'module_id' => $property->id
        ]);
        Feature::create([
            'name' => "Adjuntar archivo a la propiedad",
            'slug' => Str::slug('property-file-add'),
            'description' => 'Permite agregar archivos adjuntos a la propiedad.',
            'module_id' => $property->id
        ]);
        Feature::create([
            'name' => "Eliminar archivo adjunto de la propiedad",
            'slug' => Str::slug('property-file-delete'),
            'description' => 'Permite eliminar archivos adjuntos de la propiedad.',
            'module_id' => $property->id
        ]);

        Feature::create([
            'name' => 'Agregar foto a la propiedad',
            'slug' => Str::slug('property-add-photo'),
            'description' => 'Permite adjuntar una foto a la propiedad.',
            'module_id' => $property->id
        ]);

        Feature::create([
            'name' => 'Editar foto de la propiedad',
            'slug' => Str::slug('property-edit-photo'),
            'description' => 'Permite editar una foto de la propiedad.',
            'module_id' => $property->id
        ]);

        Feature::create([
            'name' => 'Agregar numero de telefono a la propiedad',
            'slug' => Str::slug('property-add-phone'),
            'description' => 'Permite agregar un numero de telefono a la propiedad.',
            'module_id' => $property->id
        ]);
        Feature::create([
            'name' => 'Eliminar numero de telefono a la propiedad',
            'slug' => Str::slug('property-remove-phone'),
            'description' => 'Permite eliminar un numero de telefono a la propiedad.',
            'module_id' => $property->id
        ]);


        //fin de property features

        //comienzo de phone features

        Feature::create([
            'name' => 'Visualizar lista de números de teléfono',
            'slug' => Str::slug('phone-list'),
            'description' => 'Permite ver la lista de números de teléfono.',
            'module_id' => $phones->id
        ]);
        Feature::create([
            'name' => 'Agregar un nuevo número de teléfono',
            'slug' => Str::slug('phone-add'),
            'description' => 'Permite añadir un número de teléfono al sistema.',
            'module_id' => $phones->id
        ]);
        Feature::create([
            'name' => 'Editar número de teléfono',
            'slug' => Str::slug('phone-edit'),
            'description' => 'Permite modificar un número de teléfono existente.',
            'module_id' => $phones->id
        ]);
        Feature::create([
            'name' => 'Eliminar número de teléfono',
            'slug' => Str::slug('phone-delete'),
            'description' => 'Permite eliminar un número de teléfono del sistema.',
            'module_id' => $phones->id
        ]);

        //fin de phone features

        //comienzo de service features

        Feature::create([
            'name' => 'Visualizar lista de servicios',
            'slug' => Str::slug('service-list'),
            'description' => 'Permite ver la lista completa de servicios.',
            'module_id' => $services->id
        ]);
        Feature::create([
            'name' => 'Agregar un nuevo servicio',
            'slug' => Str::slug('service-add'),
            'description' => 'Permite crear nuevos servicios.',
            'module_id' => $services->id
        ]);
        Feature::create([
            'name' => 'Editar un servicio',
            'slug' => Str::slug('service-edit'),
            'description' => 'Permite modificar un servicio existente.',
            'module_id' => $services->id
        ]);
        Feature::create([
            'name' => 'Desactivar un servicio',
            'slug' => Str::slug('service-soft'),
            'description' => 'Permite desactivar un servicio.',
            'module_id' => $services->id
        ]);
        Feature::create([
            'name' => 'Eliminar un servicio',
            'slug' => Str::slug('service-delete'),
            'description' => 'Permite eliminar un servicio de forma permanente.',
            'module_id' => $services->id
        ]);
        Feature::create([
            'name' => 'Restaurar un servicio',
            'slug' => Str::slug('service-restore'),
            'description' => 'Permite restaurar un servicio desactivado.',
            'module_id' => $services->id
        ]);

        // fin de service features

        //inicio de zone features

        Feature::create([
            'name' => 'Visualizar lista de zonas',
            'slug' => Str::slug('zone-list'),
            'description' => 'Permite ver la lista de zonas.',
            'module_id' => $zones->id
        ]);
        Feature::create([
            'name' => 'Agregar una nueva zona',
            'slug' => Str::slug('zone-add'),
            'description' => 'Permite añadir una zona al sistema.',
            'module_id' => $zones->id
        ]);
        Feature::create([
            'name' => 'Eliminar una zona',
            'slug' => Str::slug('zone-delete'),
            'description' => 'Permite eliminar una zona.',
            'module_id' => $zones->id
        ]);
        Feature::create([
            'name' => 'Editar una zona',
            'slug' => Str::slug('zone-edit'),
            'description' => 'Permite modificar los datos de una zona.',
            'module_id' => $zones->id
        ]);

        // final de zone features

        //inicio features bank accounts

        Feature::create([
            'name' => 'Visualizar lista de cuentas bancarias',
            'slug' => Str::slug('bank-account-list'),
            'description' => 'Permite ver la lista de cuentas bancarias.',
            'module_id' => $bank_accounts->id
        ]);
        Feature::create([
            'name' => 'Agregar una cuenta bancaria',
            'slug' => Str::slug('bank-account-add'),
            'description' => 'Permite añadir una cuenta bancaria al sistema.',
            'module_id' => $bank_accounts->id
        ]);
        Feature::create([
            'name' => 'Editar una cuenta bancaria',
            'slug' => Str::slug('bank-account-edit'),
            'description' => 'Permite modificar los datos de una cuenta bancaria.',
            'module_id' => $bank_accounts->id
        ]);
        Feature::create([
            'name' => 'Desactivar una cuenta bancaria',
            'slug' => Str::slug('bank-account-soft'),
            'description' => 'Permite desactivar una cuenta bancaria.',
            'module_id' => $bank_accounts->id
        ]);
        Feature::create([
            'name' => 'Eliminar una cuenta bancaria',
            'slug' => Str::slug('bank-account-delete'),
            'description' => 'Permite eliminar una cuenta bancaria.',
            'module_id' => $bank_accounts->id
        ]);
        Feature::create([
            'name' => 'Restaurar una cuenta bancaria',
            'slug' => Str::slug('bank-account-restore'),
            'description' => 'Permite restaurar una cuenta bancaria desactivada.',
            'module_id' => $bank_accounts->id
        ]);

        //final de features de bank accounts

        //inicio de tipos de visita features

        Feature::create([
            'name' => 'Visualizar lista de tipos de visitas',
            'slug' => Str::slug('visit-type-list'),
            'description' => 'Permite ver la lista de tipos de visitas.',
            'module_id' => $visit_types->id
        ]);
        Feature::create([
            'name' => 'Agregar un tipo de visita',
            'slug' => Str::slug('visit-type-add'),
            'description' => 'Permite crear un nuevo tipo de visita.',
            'module_id' => $visit_types->id
        ]);
        Feature::create([
            'name' => 'Editar un tipo de visita',
            'slug' => Str::slug('visit-type-edit'),
            'description' => 'Permite modificar un tipo de visita existente.',
            'module_id' => $visit_types->id
        ]);
        Feature::create([
            'name' => 'Desactivar un tipo de visita',
            'slug' => Str::slug('visit-type-soft'),
            'description' => 'Permite desactivar un tipo de visita.',
            'module_id' => $visit_types->id
        ]);
        Feature::create([
            'name' => 'Eliminar un tipo de visita',
            'slug' => Str::slug('visit-type-delete'),
            'description' => 'Permite eliminar un tipo de visita de forma permanente.',
            'module_id' => $visit_types->id
        ]);
        Feature::create([
            'name' => 'Restaurar un tipo de visita',
            'slug' => Str::slug('visit-type-restore'),
            'description' => 'Permite restaurar un tipo de visita desactivado.',
            'module_id' => $visit_types->id
        ]);

        //final de tipos de visita features

        //inicio de tipos de propiedades features 

        Feature::create([
            'name' => 'Visualizar lista de tipos de propiedades',
            'slug' => Str::slug('property-type-list'),
            'description' => 'Permite ver la lista de tipos de propiedades.',
            'module_id' => $property_types->id
        ]);
        Feature::create([
            'name' => 'Agregar un tipo de propiedad',
            'slug' => Str::slug('property-type-add'),
            'description' => 'Permite crear un nuevo tipo de propiedad.',
            'module_id' => $property_types->id
        ]);
        Feature::create([
            'name' => 'Editar un tipo de propiedad',
            'slug' => Str::slug('property-type-edit'),
            'description' => 'Permite modificar un tipo de propiedad existente.',
            'module_id' => $property_types->id
        ]);
        Feature::create([
            'name' => 'Desactivar un tipo de propiedad',
            'slug' => Str::slug('property-type-soft'),
            'description' => 'Permite desactivar un tipo de propiedad.',
            'module_id' => $property_types->id
        ]);
        Feature::create([
            'name' => 'Eliminar un tipo de propiedad',
            'slug' => Str::slug('property-type-delete'),
            'description' => 'Permite eliminar un tipo de propiedad de forma permanente.',
            'module_id' => $property_types->id
        ]);
        Feature::create([
            'name' => 'Restaurar un tipo de propiedad',
            'slug' => Str::slug('property-type-restore'),
            'description' => 'Permite restaurar un tipo de propiedad desactivado.',
            'module_id' => $property_types->id
        ]);

        //final de tipos de propiedades features 

        //inicio de user features

        Feature::create([
            'name' => 'Visualizar lista de usuarios',
            'slug' => Str::slug('user-list'),
            'description' => 'Permite ver la lista de usuarios del sistema.',
            'module_id' => $users->id
        ]);
        Feature::create([
            'name' => 'Agregar un usuario',
            'slug' => Str::slug('user-add'),
            'description' => 'Permite crear un nuevo usuario.',
            'module_id' => $users->id
        ]);
        Feature::create([
            'name' => 'Editar un usuario',
            'slug' => Str::slug('user-edit'),
            'description' => 'Permite modificar la información de un usuario.',
            'module_id' => $users->id
        ]);
        Feature::create([
            'name' => 'Desactivar un usuario',
            'slug' => Str::slug('user-soft'),
            'description' => 'Permite desactivar un usuario.',
            'module_id' => $users->id
        ]);
        Feature::create([
            'name' => 'Eliminar un usuario',
            'slug' => Str::slug('user-delete'),
            'description' => 'Permite eliminar un usuario de forma permanente.',
            'module_id' => $users->id
        ]);
        Feature::create([
            'name' => 'Restaurar un usuario',
            'slug' => Str::slug('user-restore'),
            'description' => 'Permite restaurar un usuario desactivado.',
            'module_id' => $users->id
        ]);

        //final de user features

        //inicio de roles features

        Feature::create([
            'name' => 'Visualizar lista de roles',
            'slug' => Str::slug('role-list'),
            'description' => 'Permite ver la lista de roles del sistema.',
            'module_id' => $roles->id
        ]);
        Feature::create([
            'name' => 'Agregar un rol',
            'slug' => Str::slug('role-add'),
            'description' => 'Permite crear un nuevo rol.',
            'module_id' => $roles->id
        ]);
        Feature::create([
            'name' => 'Editar un rol',
            'slug' => Str::slug('role-edit'),
            'description' => 'Permite modificar un rol existente.',
            'module_id' => $roles->id
        ]);
        Feature::create([
            'name' => 'Desactivar un rol',
            'slug' => Str::slug('role-soft'),
            'description' => 'Permite desactivar un rol.',
            'module_id' => $roles->id
        ]);
        Feature::create([
            'name' => 'Eliminar un rol',
            'slug' => Str::slug('role-delete'),
            'description' => 'Permite eliminar un rol de forma permanente.',
            'module_id' => $roles->id
        ]);
        Feature::create([
            'name' => 'Restaurar un rol',
            'slug' => Str::slug('role-restore'),
            'description' => 'Permite restaurar un rol desactivado.',
            'module_id' => $roles->id
        ]);

        //final de roles features

        //inicio de suscripciones features

        Feature::create([
            'name' => 'Visualizar mi suscripción',
            'slug' => Str::slug('my-suscription'),
            'description' => 'Permite ver los detalles de mi suscripción.',
            'module_id' => $subscriptions->id
        ]);

        Feature::create([
            'name' => 'Cambiar de suscripción',
            'slug' => Str::slug('suscription-change-plan'),
            'description' => 'Permite cambiar el plan de suscripción.',
            'module_id' => $subscriptions->id
        ]);
        Feature::create([
            'name' => 'Pagar plan de suscripción',
            'slug' => Str::slug('suscription-pay-plan'),
            'description' => 'Permite realizar el pago del plan de suscripción.',
            'module_id' => $subscriptions->id
        ]);
        Feature::create([
            'name' => 'Visualizar historial de pagos',
            'slug' => Str::slug('suscription-list-payments'),
            'description' => 'Permite ver el historial de pagos de suscripción.',
            'module_id' => $subscriptions->id
        ]);

        //final de suscripciones features

        //inicio de sucursales features

        Feature::create([
            'name' => 'Visualizar lista de sucursales',
            'slug' => Str::slug('branch-list'),
            'description' => 'Permite ver la lista de sucursales.',
            'module_id' => $branches->id
        ]);
        Feature::create([
            'name' => 'Agregar una sucursal',
            'slug' => Str::slug('branch-add'),
            'description' => 'Permite añadir una nueva sucursal.',
            'module_id' => $branches->id
        ]);
        Feature::create([
            'name' => 'Editar una sucursal',
            'slug' => Str::slug('branch-edit'),
            'description' => 'Permite modificar los datos de una sucursal.',
            'module_id' => $branches->id
        ]);
        Feature::create([
            'name' => 'Desactivar una sucursal',
            'slug' => Str::slug('branch-soft'),
            'description' => 'Permite desactivar una sucursal.',
            'module_id' => $branches->id
        ]);
        Feature::create([
            'name' => 'Eliminar una sucursal',
            'slug' => Str::slug('branch-delete'),
            'description' => 'Permite eliminar una sucursal de forma permanente.',
            'module_id' => $branches->id
        ]);
        Feature::create([
            'name' => 'Restaurar una sucursal',
            'slug' => Str::slug('branch-restore'),
            'description' => 'Permite restaurar una sucursal desactivada.',
            'module_id' => $branches->id
        ]);

        //final de sucursales features

        //inicio de visits features

        Feature::create([
            'name' => 'Visualizar lista de visitas',
            'slug' => Str::slug('visit-list'),
            'description' => 'Permite ver la lista de visitas programadas.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Agregar una visita',
            'slug' => Str::slug('visit-add'),
            'description' => 'Permite programar una nueva visita.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Editar una visita',
            'slug' => Str::slug('visit-edit'),
            'description' => 'Permite modificar los detalles de una visita.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Visualizar archivos adjuntos a la visita',
            'slug' => Str::slug('visit-file-list'),
            'description' => 'Permite ver los archivos adjuntos a una visita.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Adjuntar archivo a la visita',
            'slug' => Str::slug('visit-file-add'),
            'description' => 'Permite agregar archivos adjuntos a una visita.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Eliminar archivo adjunto de la visita',
            'slug' => Str::slug('visit-file-delete'),
            'description' => 'Permite eliminar archivos adjuntos de una visita.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Filtrar visitas',
            'slug' => Str::slug('visit-filter'),
            'description' => 'Permite aplicar filtros a la lista de visitas.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Agregar comentario a la visita',
            'slug' => Str::slug('visit-comment-add'),
            'description' => 'Permite añadir comentarios a una visita.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Visualizar comentarios de la visita',
            'slug' => Str::slug('visit-comment-list'),
            'description' => 'Permite ver los comentarios asociados a una visita.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Editar comentario de una visita',
            'slug' => Str::slug('visit-comment-edit'),
            'description' => 'Permite modificar comentarios de una visita.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Editar cualquier comentario de una visita',
            'slug' => Str::slug('visit-edit-any-comment'),
            'description' => 'Permite modificar cualquier comentario de una visita.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Eliminar comentario de una visita',
            'slug' => Str::slug('visit-delete-comment'),
            'description' => 'Permite eliminar comentarios de una visita.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Eliminar comentario de una visita',
            'slug' => Str::slug('visit-delete-any-comment'),
            'description' => 'Permite eliminar comentarios de una visita.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Actualizar el estado de las visitas',
            'slug' => Str::slug('visit-update-all-state'),
            'description' => 'Permite cambiar el estado de múltiples visitas.',
            'module_id' => $visits->id
        ]);
        Feature::create([
            'name' => 'Mostrar el método de pago de la visita',
            'slug' => Str::slug('visit-show-payment-method'),
            'description' => 'Permite visualizar el método de pago asociado a una visita.',
            'module_id' => $visits->id
        ]);

        //final de visits features

        //inicio de settings features

        Feature::create([
            'name' => 'Acceder a las configuraciones',
            'slug' => Str::slug('settings-show-option'),
            'description' => 'Permite acceder a las opciones de configuración.',
            'module_id' => $settings->id
        ]);
        Feature::create([
            'name' => 'Visualizar configuraciones',
            'slug' => Str::slug('settings-list'),
            'description' => 'Permite ver todas las configuraciones disponibles.',
            'module_id' => $settings->id
        ]);
        Feature::create([
            'name' => 'Ver mi perfil',
            'slug' => Str::slug('settings-my-account'),
            'description' => 'Permite ver y editar la información de mi cuenta.',
            'module_id' => $settings->id
        ]);

        //final de settings features

        //inicio de trash features

        Feature::create([
            'name' => 'Acceder a la papelera',
            'slug' => Str::slug('trash-show'),
            'description' => 'Permite acceder a los elementos eliminados.',
            'module_id' => $trash->id
        ]);
        Feature::create([
            'name' => 'Restaurar elemento de la papelera',
            'slug' => Str::slug('trash-restore'),
            'description' => 'Permite restaurar elementos desde la papelera.',
            'module_id' => $trash->id
        ]);
        Feature::create([
            'name' => 'Eliminar definitivamente elemento de la papelera',
            'slug' => Str::slug('trash-destroy'),
            'description' => 'Permite eliminar permanentemente elementos de la papelera.',
            'module_id' => $trash->id
        ]);

        //final de trash features

        //comienzo de features de leads

        Feature::create([
            'name' => 'Acceder a los leads',
            'slug' => Str::slug('leads-show'),
            'description' => 'Permite acceder y gestionar los leads.',
            'module_id' => $leads->id
        ]);

        //final de leads features


        //comienzo de features de presupuestos

        Feature::create([
            'name' => 'Acceder a los presupuestos',
            'slug' => Str::slug('budgets-list'),
            'description' => 'Permite acceder y gestionar los presupuestos.',
            'module_id' => $budgets->id,
        ]);

        //final de presupuestos features






        //comienzo de features de stock

        Feature::create([
            'name' => 'Acceder al dashboard principal de stock',
            'slug' => Str::slug('stock-list'),
            'description' => 'Permite acceder y gestionar el stock de insumos y productos.',
            'module_id' => $stock->id,
        ]);









        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-module'),
            'description' => 'Permite acceder y gestionar el stock de insumos y productos.',
            'module_id' => $stock->id,
        ]);




        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-warehouse-list'),
            'description' => 'Permite acceder y gestionar el stock de insumos y productos.',
            'module_id' => $stock->id,
        ]);
        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-warehouse-add'),
            'description' => 'Permite registrar nuevos depositos para el inventario en el modulo de stock.',
            'module_id' => $stock->id,
        ]);
        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-warehouse-edit'),
            'description' => 'Permite editar depositos para el inventario en el modulo de stock.',
            'module_id' => $stock->id,
        ]);
        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-warehouse-soft'),
            'description' => 'Permite desactivar depositos para el inventario en el modulo de stock.',
            'module_id' => $stock->id,
        ]);
        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-warehouse-restore'),
            'description' => 'Permite eliminar depositos para el inventario en el modulo de stock.',
            'module_id' => $stock->id,
        ]);

        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-warehouse-delete'),
            'description' => 'Permite eliminar depositos para el inventario en el modulo de stock.',
            'module_id' => $stock->id,
        ]);





        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-product-list'),
            'description' => 'Permite acceder y gestionar el stock de insumos y productos.',
            'module_id' => $stock->id,
        ]);
        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-product-add'),
            'description' => 'Permite registrar nuevos depositos para el inventario en el modulo de stock.',
            'module_id' => $stock->id,
        ]);
        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-product-edit'),
            'description' => 'Permite editar depositos para el inventario en el modulo de stock.',
            'module_id' => $stock->id,
        ]);
        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-product-soft'),
            'description' => 'Permite desactivar depositos para el inventario en el modulo de stock.',
            'module_id' => $stock->id,
        ]);
        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-product-restore'),
            'description' => 'Permite eliminar depositos para el inventario en el modulo de stock.',
            'module_id' => $stock->id,
        ]);

        Feature::create([
            'name' => 'Acceder al modulo de stock',
            'slug' => Str::slug('stock-product-delete'),
            'description' => 'Permite eliminar depositos para el inventario en el modulo de stock.',
            'module_id' => $stock->id,
        ]);

        //final de stock features


        //Features para el modulo de presupuestos


        Feature::create([
            'name' => 'Agregar un presupuesto',
            'slug' => Str::slug('budget-add'),
            'description' => 'Permite añadir un nuevo presupuesto al sistema.',
            'module_id' => $budgets->id
        ]);


        Feature::create([
            'name' => 'Editar información de un presupuesto',
            'slug' => Str::slug('budget-edit'),
            'description' => 'Permite modificar los datos de un presupuesto existente.',
            'module_id' => $budgets->id
        ]);

        
        Feature::create([
            'name' => 'Visualizar variables privadas de un presupuesto',
            'slug' => Str::slug('budget-show-private'),
            'description' => 'Permite visualizar las variables privadas de un presupuesto.',
            'module_id' => $budgets->id
        ]);







    }
}
