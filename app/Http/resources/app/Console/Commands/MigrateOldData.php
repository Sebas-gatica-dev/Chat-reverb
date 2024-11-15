<?php

namespace App\Console\Commands;

use App\Enums\AvailabilityDayEnums;
use App\Enums\PaymentMethodEnum;
use App\Enums\SourceEnum;
use App\Enums\StatusBudgetEnum;
use App\Enums\StatusCustomerEnum;
use App\Enums\TypeBudgetemEnum;
use App\Enums\TypeContactEnum;
use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\Budget;
use App\Models\Budgetem;
use App\Models\Business;
use App\Models\City;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Feature;
use App\Models\Industry;
use App\Models\Lead;
use App\Models\Neighborhood;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Role;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\Subzone;
use App\Models\Template;
use App\Models\User;
use App\Models\Visit;
use App\Models\VisitType;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use MercadoPago\Resources\Common\Source;

class MigrateOldData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:old-migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migración de base de datos vieja';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $planPremium = Plan::where('name', 'Plan Premium')->first();
        $templates = Template::all();
        $industries = Industry::all();
        $argentina = Country::where('name', 'Argentina')->first();

        // Obtenemos la conexión de la base de datos vieja
        $oldData = DB::connection('mysql_old');

        $negocios = $oldData->table('empresas')->whereIn('nombre', ['Protegel'])->get();






        foreach ($negocios as $negocio) {

            $users = $oldData->table('users')->where('empresa_id', $negocio->id)->orderBy('created_at')->chunk(100, function ($usuariosOld) {
                foreach ($usuariosOld as $usuario) {


                    $latitude = null;
                    $longitude = null;

                    do {
                        $baseLatitude = -34.62; // Un punto central en Buenos Aires
                        $baseLongitude = -58.44; // Un punto central en Buenos Aires

                        $variationLat = 0.027; // Aproximadamente 3 km de variación en latitud
                        $variationLng = 0.0336; // Aproximadamente 3 km de variación en longitud

                        // Generar coordenadas con mayor precisión
                        $latitude = round($baseLatitude + mt_rand(-1000, 1000) / 1000 * $variationLat, 6);
                        $longitude = round($baseLongitude + mt_rand(-1000, 1000) / 1000 * $variationLng, 6);

                        // Margen de tolerancia para evitar colisiones en el almacenamiento (aumenta o reduce según sea necesario)
                        $tolerance = 0.0001;

                        // Verificar si ya existe una propiedad cercana dentro de un rango pequeño
                        $existingUser = \App\Models\User::whereBetween('start_lat', [$latitude - $tolerance, $latitude + $tolerance])
                            ->whereBetween('start_lng', [$longitude - $tolerance, $longitude + $tolerance])
                            ->first();
                    } while ($existingUser); // Repetir mientras haya una propiedad con las mismas coordenadas


                    // Insertamos los datos en la nueva tabla de la base de datos nueva
                    DB::table('users')->insert([
                        'id' => $usuario->id,
                        'name' => $usuario->nombre,
                        'email' => $usuario->email,
                        'email_verified_at' => $usuario->email_verified_at,
                        'password' => Hash::make('password'),
                        'transport' => 'car',
                        'start_lat' => $latitude,
                        'start_lng' => $longitude,
                        'deleted_at' => $usuario->deleted_at,
                        'created_at' => $usuario->created_at,
                        'updated_at' => $usuario->updated_at,
                    ]);
                }
            });


            $newBusiness = Business::create([
                'id' => $negocio->id,
                'name' => $negocio->nombre,
                'email' => $negocio->email,
                'industry_id' => $industries->random()->id,
                'created_at' => $negocio->created_at,
                'updated_at' => $negocio->updated_at,
            ]);



            $sucursales = $oldData->table('sucursales')->where('empresa_id', $negocio->id)->get();

            foreach ($sucursales as $sucursal) {
                $branches = Branch::create([
                    'id' => $sucursal->id,
                    'name' => $sucursal->nombre,
                    'address' => $sucursal->direccion,
                    'business_id' => $newBusiness->id,
                    'created_by' => $negocio->creado_por,
                    'deleted_at' => $sucursal->deleted_at,
                    'created_at' => $sucursal->created_at,
                    'updated_at' => $sucursal->updated_at,
                ]);
            }


            $tiposVisita = $oldData->table('tipo_visitas')->where('empresa_id', $newBusiness->id)->get();

            foreach ($tiposVisita as $tipo) {
                $newService = VisitType::create([
                    'id' => $tipo->id,
                    'name' => $tipo->nombre,
                    'business_id' => $tipo->empresa_id,
                    'created_at' => $tipo->created_at,
                    'updated_at' => $tipo->updated_at,
                    'deleted_at' => $tipo->deleted_at,
                ]);
            }


            $tiposVisita = $oldData->table('plagas')->where('empresa_id', $newBusiness->id)->get();

            foreach ($tiposVisita as $tipo) {
                $newService = Service::create([
                    'id' => $tipo->id,
                    'name' => $tipo->nombre,
                    'business_id' => $tipo->empresa_id,
                    'created_at' => $tipo->created_at,
                    'updated_at' => $tipo->updated_at,
                    'deleted_at' => $tipo->deleted_at,
                ]);
            }


            $newBusiness->countries()->create([
                'country_id' => $argentina->id,
            ]);

            $provinces = $argentina->provinces()->whereIn('name', ['Capital Federal', 'GBA Norte', 'GBA Sur', 'GBA Oeste'])->get();

            foreach ($provinces as $province) {
                $newBusiness->provinces()->create([
                    'province_id' => $province->id,
                ]);
            }

            $cities = City::whereIn('province_id', $provinces->pluck('id'))->get();
            foreach ($cities as $city) {
                $newBusiness->cities()->create([
                    'city_id' => $city->id,
                ]);
            }

            $neighborhoods = Neighborhood::whereIn('city_id', $cities->pluck('id'))->get();

            foreach ($neighborhoods as $neighborhood) {
                $newBusiness->neighborhoods()->create([
                    'neighborhood_id' => $neighborhood->id,
                ]);
            }
            $subzones = Subzone::whereIn('neighborhood_id', $neighborhoods->pluck('id'))->get();
            if (!$subzones->isEmpty()) {
                foreach ($subzones as $subzone) {
                    $newBusiness->subzones()->create([
                        'subzone_id' => $subzone->id,
                    ]);
                }
            }


            $users = $oldData->table('users')->where('empresa_id', $negocio->id)->orderBy('created_at')->chunk(100, function ($usuariosOld) use ($negocio, $templates, $provinces, $cities, $neighborhoods, $subzones, $branches) {
                foreach ($usuariosOld as $usuario) {
                    $user = User::withTrashed()->where('id', $usuario->id)->first();
                    $user->business_id = $negocio->id;
                    $user->save();
                    $user->templates()->attach($templates->random()->id);



                    foreach (AvailabilityDayEnums::cases() as $dayEnum) {
                        // Crear la disponibilidad para cada día de la semana con el horario de 08:00 a 14:00
                        $user->availabilities()->create([
                            'day' => $dayEnum->value, // Usamos el valor del enum para definir el día
                            'start_time' => '08:00',
                            'end_time' => '14:00',
                        ]);
                    }

                    $admin = Role::create([
                        'name' => 'Administrador',
                        'description' => 'Rol de administrador',
                        'business_id' => null,
                    ]);

                    $vendedor = Role::create([
                        'name' => 'Vendedor',
                        'description' => 'Rol de vendedor',
                        'business_id' => null,
                    ]);

                    $operario = Role::create([
                        'name' => 'Operario',
                        'description' => 'Rol de operario',
                        'business_id' => null,
                    ]);

                    $admin->features()->attach(Feature::all()->pluck('id'));

                    $vendedor->features()->attach(Feature::all()->pluck('id'));

                    $operario->features()->attach(Feature::all()->pluck('id'));

                    $user->roles()->attach($admin->id);

                    $user->branches()->attach($branches->pluck('id'));

                    // foreach ($provinces as $province) {
                    //     $user->provinces()->create([
                    //         'province_id' => $province->id,
                    //     ]);
                    // }

                    // foreach ($cities as $city) {
                    //     $user->cities()->create([
                    //         'city_id' => $city->id,
                    //     ]);
                    // }

                    // foreach ($neighborhoods as $neighborhood) {
                    //     $user->neighborhoods()->create([
                    //         'neighborhood_id' => $neighborhood->id,
                    //     ]);
                    // }

                    // foreach ($subzones as $subzone) {
                    //     $user->subzones()->create([
                    //         'subzone_id' => $subzone->id,
                    //     ]);
                    // }
                }
            });

            $newBusiness->created_by = $negocio->creado_por;
            $newBusiness->save();


            $subscription = Subscription::create([
                'business_id' => $newBusiness->id,
                'plan_id' => $planPremium->id,
                'status' => 1,
                'starts_at' => now(),
                'ends_at' => now()->addMonth(),
                'payment_method' => 'mercado_pago',
            ]);


            //sucursales

            $payment = Payment::create([
                'subscription_id' => $subscription->id,
                'amount' => 1000,
                'status' => 1,
                'currency' => 'ARS',
                'payment_method' => 'mercado_pago',
            ]);



            //tipo de propiedades

            $tiposPropiedades = $oldData->table('tipo_propiedades')->where('empresa_id', $negocio->id)->get();

            foreach ($tiposPropiedades as $tipoPropiedad) {
                PropertyType::create([
                    'id' => $tipoPropiedad->id,
                    'name' => $tipoPropiedad->nombre,
                    'business_id' => $newBusiness->id,
                    'created_at' => $tipoPropiedad->created_at,
                    'updated_at' => $tipoPropiedad->updated_at,
                ]);
            }


            //clientes

            $clientes = $oldData->table('clientes')->where('empresa_id', $negocio->id)->take(100)->get();


            foreach ($clientes as $cliente) {

                $phoneOrder = 0;

                $customers = Customer::create([
                    'id' => $cliente->id,
                    'name' => $cliente->nombre,
                    'surname' => $cliente->apellido,
                    'status' => StatusCustomerEnum::CLOSED->value,
                    'email' => $cliente->email,
                    'gender' => $cliente->genero == 1 ? 'female' : 'male',
                    'business_id' => $newBusiness->id,
                    'source' => $this->mapSource($cliente->fuente_id),
                    'deleted_at' => $cliente->deleted_at,
                    'created_by' => $cliente->creado_por,
                    'created_at' => $cliente->created_at,
                    'updated_at' => $cliente->updated_at,

                ]);

                //phones

                $telefonos = $oldData->table('telefonos')->where('telefoneable_type', 'App\Models\Cliente')->where('telefoneable_id', $cliente->id)->get();

                foreach ($telefonos as $telefono) {
                    $customers->phones()->create([
                        'id' => $telefono->id,
                        'tag' => $telefono->titulo,
                        'number' => $telefono->numero,
                        'type' => 0,
                        'order' => $phoneOrder,
                        'phoneable_id' => $cliente->id,
                        'phoneable_type' => 'App\Models\Customer',
                        'created_at' => $telefono->created_at,
                        'updated_at' => $telefono->updated_at,
                    ]);

                    $phoneOrder = $phoneOrder + 1;
                }

                // propiedades


                $propiedades = $oldData->table('propiedades')->where('cliente_id', $cliente->id)->get();

                foreach ($propiedades as $propiedad) {

                    $frecuencia = $propiedad->frecuencia_id;

                    // Si la frecuencia en la vieja es 0 (Frecuencia), la mapeamos a 9 (SinFrecuencia) en la nueva.
                    if ($frecuencia == null) {
                        $frecuencia = 10; // SinFrecuencia
                    }
                    $properties = Property::create([
                        'id' => $propiedad->id,
                        'property_name' => $propiedad->titulo,
                        'property_type' => $propiedad->tipo_id,
                        'documentation' => $propiedad->cuit,
                        'frequency' => $frecuencia,
                        'branch_id' => $propiedad->sucursal_id,
                        'created_by' => $propiedad->creado_por,
                        'address' => $propiedad->direccion,
                        'between_streets' => $propiedad->entre_calles,
                        'floor' => $propiedad->piso,
                        'apartment' => $propiedad->departamento,
                        'latitude' => $propiedad->latitud,
                        'longitude' => $propiedad->longitud,
                        'country_id' => $propiedad->pais_id,
                        'province_id' => $propiedad->provincia_id,
                        'city_id' => $propiedad->ciudad_id,
                        'neighborhood_id' => $propiedad->barrio_id,
                        'subzone_id' => $propiedad->subzona_id,
                        'customer_id' => $propiedad->cliente_id,
                        'business_id' => $newBusiness->id,
                        'deleted_at' => $propiedad->deleted_at,
                        'created_at' => $propiedad->created_at,
                        'updated_at' => $propiedad->updated_at,
                    ]);


                    $telefonos = $oldData->table('telefonos')->where('telefoneable_type', 'App\Models\Propiedad')->where('telefoneable_id', $propiedad->id)->get();

                    foreach ($telefonos as $telefono) {
                        $customers->phones()->create([
                            'id' => $telefono->id,
                            'tag' => $telefono->titulo,
                            'number' => $telefono->numero,
                            'type' => 0,
                            'order' => $phoneOrder,
                            'phoneable_id' => $cliente->id,
                            'phoneable_type' => 'App\Models\Property',
                            'created_at' => $telefono->created_at,
                            'updated_at' => $telefono->updated_at,
                        ]);

                        $phoneOrder = $phoneOrder + 1;
                    }

                    //visitas

                    $visitas = $oldData->table('visitas')->where('propiedad_id', $propiedad->id)->get();
                    foreach ($visitas as $visita) {

                        switch ($visita->estado) {
                            case '0':
                                $newStatus = 0; // Pending
                                break;
                            case '1':
                                $newStatus = 3; // InProgress
                                break;
                            case '2':
                                $newStatus = 4; // Completed
                                break;
                            case '3':
                                $newStatus = 6; // Cancelled
                                break;
                            default:
                                $newStatus = 7; // Incomplete (estado desconocido)
                                break;
                        }



                        $visit = Visit::create([
                            'id' => $visita->id,
                            'date' => $visita->fecha,
                            'time' => $visita->hora,
                            'price' => is_numeric($visita->precio)
                                ? (floor($visita->precio) == $visita->precio
                                    ? (int)$visita->precio // Si es entero, lo convertimos a entero
                                    : number_format((float)$visita->precio, 2, ',', '')) // Si tiene decimales, los formateamos con coma
                                : 0,
                            'iva' => $visita->iva,
                            'status' => $newStatus,
                            'expected_payment' => $this->mapPayment($visita->pago_id), // Mapeo de 'forma_pago' a 'expected_payment'
                            'visit_type_id' => $visita->tipo_id, // Mapeo del tipo de visita
                            'property_id' => $visita->propiedad_id, // Mapeo de propiedad
                            'customer_id' => $cliente->id, // Mapeo de cliente
                            'created_by' => $visita->creado_por,
                            'business_id' => $newBusiness->id, // Mapeo de empresa a business
                            'duration_time' => 45, // Asumo que cant_comision corresponde a duration_time
                            'created_at' => $visita->created_at,
                            'deleted_at' => $visita->deleted_at,
                            'updated_at' => $visita->updated_at,
                        ]);


                        //plagas

                        $plagas = $oldData->table('plaga_visita')->where('visita_id', $visita->id)->get();

                        foreach ($plagas as $plaga) {
                            $visit->services()->attach($plaga->plaga_id);
                        }

                        //usuarios que hacen la visita

                        $usuariosVisita = $oldData->table('user_visita')->where('visita_id', $visita->id)->get();

                        //verificar si el usuario existe en la base de datos nueva

                        foreach ($usuariosVisita as $usuarioVisita) {
                            $userVerification = User::find($usuarioVisita->user_id);

                            if ($userVerification) {
                                $visit->users()->attach($usuarioVisita->user_id);
                            }
                        }

                        //comentarios
                        $comentarios = $oldData->table('comentarios')->where('comentable_id', $visita->id)->get();

                        foreach ($comentarios as $comentario) {

                            $userVerification = User::find($comentario->user_id);

                            if ($userVerification) {
                                $comments = Comment::create([
                                    'id' => $comentario->id,
                                    'message' => $comentario->comentario,
                                    'user_id' => $comentario->user_id,
                                    'commentable_id' => $comentario->comentable_id,
                                    'commentable_type' => 'App\Models\Visit',
                                    'deleted_at' => $comentario->deleted_at,
                                    'created_at' => $comentario->created_at,
                                    'updated_at' => $comentario->updated_at,
                                ]);
                            }
                        }
                    }
                }
            }

            //Bank accounts

            $bancos = $oldData->table('cuentas_bancarias')->where('empresa_id', $negocio->id)->get();

            foreach($bancos as $banco){
            $bankAccounts = BankAccount::create([
                'id' => $banco->id,
                'name' => $banco->nombre,
                'cbu' => $banco->cbu,
                'deleted_at' => $banco->deleted_at,
                'business_id' => $banco->empresa_id,
                'created_at' => $banco->created_at,
                'updated_at' => $banco->updated_at,
            ]);
        }



            // variables presupuestarias

            $variablesPresupuestarias = $oldData->table('variables')->where('empresa_id', $negocio->id)->get();

            foreach ($variablesPresupuestarias as $variable) {
                $newVariable = Budgetem::create([
                    'id' => $variable->id,
                    'name' => $variable->nombre,
                    'description' => $variable->descripcion,
                    'description_item' => $variable->descripcion,
                    'value' => $variable->valor,
                    'default_quantity' => $variable->default,
                    'operator' => $variable->tipo_accion,
                    'type' => TypeBudgetemEnum::COUNTABLE->value,
                    'min' => $variable->minimo,
                    'max' => $variable->maximo,
                    'visible_doc' => $variable->visible,
                    'business_id' => $variable->empresa_id,
                    'created_at' => $variable->created_at,
                    'updated_at' => $variable->updated_at,
                ]);
            }


            //leads
            $leads = $oldData->table('leads')->where('empresa_id', $negocio->id)->where('estado', '!=', 4)->take(100)->get();

            foreach ($leads as $lead) {
                $leadNew = Customer::create([
                    'id' => $lead->id,  // Asumiendo que quieres mantener el mismo ID
                    'status' => StatusCustomerEnum::IN_PROCESS->value, // Por defecto, en curso
                    'date_lead' => $lead->fecha, // Mapeo de 'fecha' a 'date'
                    'time_lead' => $lead->hora, // Mapeo de 'hora' a 'time'
                    'name' => $lead->nombre, // Mapeo de 'nombre' a 'name'
                    'surname' => $lead->apellido, // Mapeo de 'apellido' a 'surname'
                    'email' => $lead->email, // Mismo campo
                    'gender' => ($lead->genero == 1) ? 'male' : 'female', // Adaptando el valor numérico de 'genero' a 'male/female'
                    'source' => $this->mapSource($lead->fuente_id), // Necesitarás una función para mapear 'fuente_id' al nuevo enum de 'source'
                    'type_contact' => $this->mapTypeContact($lead->tipo_contacto), // Lo mismo para 'tipo_contacto'
                    'status' => $this->mapStatus($lead->estado), // Mapeo de 'estado' al nuevo enum de 'status'
                    // 'description' => $lead->descripcion, // Mismo campo
                  
                    'created_by' => $lead->creador_id, // Mapeo de 'creador_id' a 'created_by'
                    'business_id' => $lead->empresa_id, // Mapeo de 'empresa_id' a 'business_id'
                    // 'customer_id' => $lead->cliente_id, // Mapeo de 'cliente_id' a 'customer_id'
                    'deleted_at' => $lead->deleted_at, // Mismo campo
                    'created_at' => $lead->created_at, // Mismo campo
                    'updated_at' => $lead->updated_at, // Mismo campo
                ]);

                $leadNew->phones()->create([
                    'number' => $lead->telefono,
                    'tag' => 'Principal',
                    'type' => 0,
                    'order' => 0,
                ]);


               $propertyLead = Property::create([

                    'property_name' => 'Principal',
                    'customer_id' => $leadNew->id,
                    'branch_id' => $lead->sucursal_id,
                    // 'address' => $lead->direccion,
                    'country_id' => $lead->pais_id,
                    'province_id' => $lead->provincia_id,
                    'city_id' => $lead->ciudad_id,
                    'neighborhood_id' => $lead->barrio_id,
                    'subzone_id' => $lead->subzona_id,
                    'property_type' => $lead->tipo_propiedad,
                    'business_id' => $lead->empresa_id,
                    'created_by' => $lead->creador_id,
                    'created_at' => $lead->created_at,
                    'updated_at' => $lead->updated_at,
                ]);


                if ($lead->presupuesto_id) {
                    $presupuesto = $oldData->table('presupuestos')->where('id', $lead->presupuesto_id)->first();

                    if ($presupuesto) {

                      $budget = Budget::create([
                            'id' => $lead->presupuesto_id,
                            'name' => $lead->presupuesto_id,
                            'status' => StatusBudgetEnum::NOT_GENERATED->value,
                            'customer_id' => $lead->id,
                            'property_id' => $propertyLead->id,
                            'budgetems_private' => 0,
                            'total' => $presupuesto->total,
                            'iva' => $presupuesto->iva,
                            'business_id' => $lead->empresa_id,
                            'created_at' => $lead->created_at,
                            'updated_at' => $lead->updated_at,
                        ]);

                        $variablesDelPresupuesto = $oldData->table('presupuesto_variable')->where('presupuesto_id', $lead->presupuesto_id)->get();


                        foreach($variablesDelPresupuesto as $variablePresupuesto) {
                            DB::table('budget_budgetem')->insert([
                                'itemable_id' => $variablePresupuesto->variable_id,
                                'itemable_type' => 'App\Models\Budgetem',
                                'budgetable_id' => $variablePresupuesto->presupuesto_id,
                                'budgetable_type' => 'App\Models\Budget',
                                'quantity' => $variablePresupuesto->cantidad,
                                'value' => $variablePresupuesto->unidad,
                                'total' => $variablePresupuesto->subtotal,
                                'visible_doc' => $variablePresupuesto->vista,
                                'created_at' => $variablePresupuesto->created_at,
                                'updated_at' => $variablePresupuesto->updated_at,
                            ]);
                       
                        }

                        // dispatch(new \App\Jobs\GenerateBudgetPdf($budget->id));


                    }
                }
            }
        }


        $this->info('Data migration complete!');
    }

    function mapSource($fuente_id)
    {
        $map = [
            0 => SourceEnum::OTHER->value, // Facebook
            1 => SourceEnum::GOOGLE_ADS->value, // Google Ads
            2 => SourceEnum::RECOMMENDATION->value, // Recomendación -> Recommendation
            3 => SourceEnum::OTHER->value, // Twitter
            4 => SourceEnum::FACEBOOK->value, // Orgánico
            5 => SourceEnum::INSTAGRAM->value,
            6 => SourceEnum::MERCADOLIBRE->value
        ];

        return $map[$fuente_id] ?? SourceEnum::OTHER->value;
    }


    function mapPayment($payment)
    {
        $map = [
            0 => PaymentMethodEnum::Pending->value, // Efectivo
            1 => PaymentMethodEnum::Cash->value, // Tarjeta de crédito
            2 => PaymentMethodEnum::Transfer->value, // Tarjeta de débito
            3 => PaymentMethodEnum::Card->value, // Transferencia
            4 => PaymentMethodEnum::Check->value, // Cheque
            5 => PaymentMethodEnum::Deposit->value, // Depósito
            6 => PaymentMethodEnum::MercadoPago->value, // Mercado Pago
            7 => PaymentMethodEnum::MultiplePayment->value, // Pago Múltiple
            8 => PaymentMethodEnum::NoPayment->value, // Sin Pago
        ];
            
            return $map[$payment] ?? PaymentMethodEnum::Other->value;
    }

    function mapTypeContact($tipo_contacto)
    {
        $map = [
            1 => TypeContactEnum::PHONECALL->value, // Llamado telefónico
            2 => TypeContactEnum::EMAIL->value,     // Email
            3 => TypeContactEnum::WHATSAPP->value,  // Whatsapp
            4 => TypeContactEnum::IN_PERSON->value, // Presencial
        ];

        return $map[$tipo_contacto] ?? TypeContactEnum::OTHER->value; // En caso de que haya otros valores, se asigna "Otro"
    }

    function mapStatus($estado)
    {
        $map = [
            1 => StatusCustomerEnum::IN_PROCESS->value,     // En curso
            2 => StatusCustomerEnum::BUDGETED->value,       // Presupuestado
            3 => StatusCustomerEnum::TO_VISIT->value,       // A visitar
            4 => StatusCustomerEnum::CLOSED->value,      // Concretado
            5 => StatusCustomerEnum::NOT_CLOSED->value,  // No concretado
        ];

        return $map[$estado] ?? 'Sin definir'; // En caso de que haya un valor inesperado
    }
}
