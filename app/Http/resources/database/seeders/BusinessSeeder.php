<?php

namespace Database\Seeders;

use App\Enums\StatusVisitEnum;
use App\Models\Branch;
use App\Models\Budgetem;
use App\Models\Business;
use App\Models\City;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Industry;
use App\Models\Neighborhood;
use App\Models\Payment;
use App\Models\Phone;
use App\Models\Plan;
use App\Models\PropertyType;
use App\Models\Province;
use App\Models\Role;
use App\Models\Service;
use App\Models\Subscription;
use App\Models\Subzone;
use App\Models\Template;
use App\Models\User;
use App\Models\Visit;
use App\Models\VisitType;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planPremium = Plan::where('name', 'Plan Premium')->first();
        if (!$planPremium) {
            throw new \Exception("Plan Premium no encontrado.");
        }

        $planAdvanced = Plan::where('name', 'Plan Avanzado')->first();
        if (!$planAdvanced) {
            throw new \Exception("Plan Avanzado no encontrado.");
        }

        $planBasic = Plan::where('name', 'Plan Básico')->first();
        if (!$planBasic) {
            throw new \Exception("Plan Básico no encontrado.");
        }

        $argentina = Country::where('name', 'Argentina')->first();
        if (!$argentina) {
            throw new \Exception("País Argentina no encontrado.");
        }

        $industries = Industry::all();
        if ($industries->isEmpty()) {
            throw new \Exception("No hay industrias disponibles.");
        }

        $rolesTemplate = Role::where('business_id', null)->get();
        if ($rolesTemplate->isEmpty()) {
            throw new \Exception("No hay roles disponibles.");
        }

        $firstIteration = true;

        $templates = Template::all();

        for ($i = 0; $i < 1; $i++) {
            if ($firstIteration) {
                $user = User::factory()->create([
                    'name' => 'Dizeg',
                    'email' => 'dizeg@gmail.com',
                ]);

                $business = Business::factory()->create([
                    'name' => 'Protegel',
                    'email' => 'ventas@protegel.com',
                    // 'address' => 'Calle Falsa 123',
                    'created_by' => $user->id,
                    'industry_id' => $industries->random()->id,
                ]);



                $firstIteration = false;
            } elseif ($i == 1) {
                $user = User::factory()->create(
                    [
                        'name' => 'Plan Avanzado',
                        'email' => 'advance@gmail.com',
                    ]
                );

                $business = Business::factory()->create([
                    'industry_id' => $industries->random()->id,
                    'created_by' => $user->id,
                ]);
            } elseif ($i == 2) {
                $user = User::factory()->create(
                    [
                        'name' => 'Plan Básico',
                        'email' => 'basic@gmail.com',
                    ]
                );

                $business = Business::factory()->create([
                    'industry_id' => $industries->random()->id,
                    'created_by' => $user->id,
                ]);
            } else {
                $user = User::factory()->create();
                $business = Business::factory()->create([
                    'industry_id' => $industries->random()->id,
                    'created_by' => $user->id,
                ]);
            }


            $user->update(['business_id' => $business->id]);

            $user->templates()->attach($templates->random()->id);





            $user->availabilities()->create([
                'day' => 'monday',
                'start_time' => '08:00',
                'end_time' => '17:00',
            ]);

            $user->availabilities()->create([
                'day' => 'tuesday',
                'start_time' =>'08:00',
                'end_time' =>'17:00',
            ]);

            $user->availabilities()->create([
                'day' => 'wednesday',
                'start_time' =>'08:00',
                'end_time' =>'17:00',
            ]);

            $user->availabilities()->create([
                'day' => 'thursday',
                'start_time' =>'08:00',
                'end_time' =>'17:00',
            ]);

            $user->availabilities()->create([
                'day' => 'friday',
                'start_time' =>'08:00',
                'end_time' =>'17:00',
            ]);

            $business->countries()->create([
                'country_id' => $argentina->id,
            ]);

            $provinces = $argentina->provinces()->inRandomOrder()->limit(rand(2, 3))->get();
            if ($provinces->isEmpty()) {
                throw new \Exception("No se encontraron provincias para Argentina.");
            }

            foreach ($provinces as $province) {
                $business->provinces()->create([
                    'province_id' => $province->id,
                ]);
            }
            $cities = City::whereIn('province_id', $provinces->pluck('id'))->get();
            if ($cities->isEmpty()) {
                throw new \Exception("No se encontraron ciudades para las provincias seleccionadas.");
            }

            foreach ($cities as $city) {
                $business->cities()->create([
                    'city_id' => $city->id,
                ]);
            }

            $neighborhoods = Neighborhood::whereIn('city_id', $cities->pluck('id'))->get();
            if ($neighborhoods->isEmpty()) {
                throw new \Exception("No se encontraron barrios para las ciudades seleccionadas.");
            }

            foreach ($neighborhoods as $neighborhood) {
                $business->neighborhoods()->create([
                    'neighborhood_id' => $neighborhood->id,
                ]);
            }
            $subzones = Subzone::whereIn('neighborhood_id', $neighborhoods->pluck('id'))->get();
            if (!$subzones->isEmpty()) {
                foreach ($subzones as $subzone) {
                    $business->subzones()->create([
                        'subzone_id' => $subzone->id,
                    ]);
                }
            }

            $branches = Branch::factory(rand(1, 2))->create([
                'business_id' => $business->id,
                'created_by' => $user->id,
            ]);


            $user->branches()->attach($branches->pluck('id'));

            foreach ($rolesTemplate as $role) {
                $newRole = $role->replicate();
                $newRole->business_id = $business->id;
                $newRole->save();
                $newRole->features()->attach($role->features()->pluck('id'));
            }

            $businessRoles = $business->roles()->get();
            $user->roles()->attach($businessRoles->where('name', 'Administrador')->first()->id);



            $propertyTypes = PropertyType::factory(rand(5, 15))->create(['business_id' => $business->id]);
            $visitTypes = VisitType::factory(rand(5, 15))->create(['business_id' => $business->id]);
            $services = Service::factory(rand(5, 15))->create(['business_id' => $business->id]);


            if ($i == 0) {
                $subscription = Subscription::factory()->create([
                    'business_id' => $business->id,
                    'plan_id' => $planPremium->id,
                    'status' => 1,
                    'starts_at' => now(),
                    'ends_at' => now()->addMonth(),
                    'payment_method' => 'stripe',
                ]);
            } elseif ($i == 1) {
                $subscription = Subscription::factory()->create([
                    'business_id' => $business->id,
                    'plan_id' => $planAdvanced->id,
                    'status' => 1,
                    'starts_at' => now(),
                    'ends_at' => now()->addMonth(),
                    'payment_method' => 'stripe',
                ]);
            } else {
                $subscription = Subscription::factory()->create([
                    'business_id' => $business->id,
                    'plan_id' => $planBasic->id,
                    'status' => 1,
                    'starts_at' => now(),
                    'ends_at' => now()->addMonth(),
                    'payment_method' => 'stripe',
                ]);
            }

            Payment::factory(rand(1, 5))->create(['subscription_id' => $subscription->id]);

            $users = User::factory(rand(2, 2))->create(['business_id' => $business->id]);

            foreach ($users as $newUser) {
                $newUser->roles()->attach($businessRoles->where('name', 'Administrador')->first()->id);
                $newUser->branches()->attach($branches->pluck('id'));

                $newUser->templates()->attach($templates->random()->id);

                $newUser->availabilities()->create([
                    'day' => 'monday',
                    'start_time' =>'08:00',
                    'end_time' =>'17:00',
                ]);

                $newUser->availabilities()->create([
                    'day' => 'tuesday',
                    'start_time' =>'08:00',
                    'end_time' =>'17:00',
                ]);

                $newUser->availabilities()->create([
                    'day' => 'wednesday',
                    'start_time' =>'08:00',
                    'end_time' =>'17:00',
                ]);

                $newUser->availabilities()->create([
                    'day' => 'thursday',
                    'start_time' =>'08:00',
                    'end_time' =>'17:00',
                ]);

                $newUser->availabilities()->create([
                    'day' => 'friday',
                    'start_time' =>'08:00',
                    'end_time' =>'17:00',
                ]);


                foreach ($provinces as $province) {
                    $newUser->provinces()->create([
                        'province_id' => $province->id,
                    ]);
                }

                foreach ($cities as $city) {
                    $newUser->cities()->create([
                        'city_id' => $city->id,
                    ]);
                }

                foreach ($neighborhoods as $neighborhood) {
                    $newUser->neighborhoods()->create([
                        'neighborhood_id' => $neighborhood->id,
                    ]);
                }

                foreach ($subzones as $subzone) {
                    $newUser->subzones()->create([
                        'subzone_id' => $subzone->id,
                    ]);
                }
            }


            $budgetem1 = Budgetem::create([
                'name' => 'Publicidad',
                'value' => 10000,
                'description' => 'Costo de publicidad de la campaña de GoogleAds',
                'description_item' => 'Costo publicitario',
                'operator' => true,
                'type' => 'fixed',
                'visible_doc' => true,
                'private' => true,
                'business_id' => $business->id,
            ]);




            $budgetem1 = Budgetem::create([
                'name' => 'Costos de administración',
                'value' => 10,
                'description' => 'Costo de administración de la empresa',
                'description_item' => 'Costo variable', 
                'operator' => true,
                'min' => 10,
                'max' => 10,
                'default_quantity' => 10,
                'type' => 'percentage',
                'visible_doc' => true,
                'private' => true,
                'business_id' => $business->id,
            ]);

            $budgetem1 = Budgetem::create([
                'name' => 'Herramientas de uso',
                'value' => 25000,
                'description' => 'Se usa el par de guantes en cada visita',
                'description_item' => 'Herramientas',
                'operator' => true,
                'type' => 'fixed',
                'visible_doc' => true,
                'private' => false,
                'business_id' => $business->id,
            ]);

            $budgetem1 = Budgetem::create([
                'name' => 'Nafta x km',
                'value' => 150,
                'description' => 'Costo de nafta por km recorrido',
                'description_item' => 'Viaticos',
                'operator' => true,
                'default_quantity' => 10,
                'min' => 10,
                'max' => 300,
                'type' => 'countable',
                'visible_doc' => true,
                'private' => false,
                'business_id' => $business->id,
            ]);

            $budgetem1 = Budgetem::create([
                'name' => 'Ganancia del operario',
                'value' => 15000,
                'description' => 'Es la ganancia que se le paga al operario por cada visita',
                'description_item' => 'Mano de obra',
                'operator' => true,
                'default_quantity' => 1,
                'min' => 1,
                'max' => 5,
                'type' => 'countable',
                'visible_doc' => true,
                'private' => false,
                'business_id' => $business->id,
            ]);



            $customers = \App\Models\Customer::factory(rand(40, 50))->create([
                'business_id' => $business->id,
                'created_by' => $user->id,
            ]);

         

            foreach ($customers as $customer) {
                if ($propertyTypes->isEmpty() || $branches->isEmpty() || $provinces->isEmpty() || $cities->isEmpty() || $neighborhoods->isEmpty() || $subzones->isEmpty() || $visitTypes->isEmpty() || $services->isEmpty()) {
                    continue;
                }




                $province = $business->provinces()->inRandomOrder()->first();



                if ($province) {
                    $city = City::has('neighborhoods')->where('province_id', $province->province_id)->inRandomOrder()->first();

                    if ($city) {
                        $neighborhood = Neighborhood::has('subzones')->where('city_id', $city->id)->inRandomOrder()->first();

                        if ($neighborhood) {
                            $subzone = Subzone::where('neighborhood_id', $neighborhood->id)->inRandomOrder()->first();

                            if (!$subzone) {
                                $subzone = null;
                            } else {
                                $subzone = $subzone->id;
                            }
                        } else {
                            $subzone = null; // o algún otro valor predeterminado
                        }
                    } else {
                        $subzone = null; // o algún otro valor predeterminado
                    }
                } else {
                    $subzone = null; // o algún otro valor predeterminado
                }



                $properties = \App\Models\Property::factory(rand(1, 1))->create([
                    'property_type' => $propertyTypes->random()->id,
                    'business_id' => $business->id,
                    'customer_id' => $customer->id,
                    'created_by' => $users->random()->id,
                    'branch_id' => $branches->random()->id,
                    'country_id' => $argentina->id,
                    'province_id' => $province->province_id,
                    'city_id' => $city->id,
                    'neighborhood_id' => $neighborhood->id,
                    'subzone_id' => $subzone,
                ]);

                $properties->each(function ($property) {
                    Phone::factory(rand(1, 3))->create([
                        'phoneable_id' => $property->id,
                        'phoneable_type' => 'App\Models\Property',
                    ]);


                    $visitas = Visit::factory(rand(1, 1))->create([
                        'property_id' => $property->id,
                        'customer_id' => $property->customer_id,
                        'created_by' => User::where('business_id', $property->business_id)->inRandomOrder()->first()->id,
                        'business_id' => $property->business_id,
                        'visit_type_id' => VisitType::where('business_id', $property->business_id)->inRandomOrder()->first()->id,
                    ]);

                    foreach ($visitas as $visita) {

                        //agregar de 1 a 3 servicios random de la variable $service a la visita
                        $visita->services()->attach(Service::where('business_id', $property->business_id)->inRandomOrder()->limit(rand(1, 3))->pluck('id'));

                        $visita->users()->attach(User::where('business_id', $property->business_id)->inRandomOrder()->limit(rand(1, 1))->pluck('id'));;


                        $statusVisitEnum = StatusVisitEnum::cases();
                        $iterationStatusVisit = array_search($visita->status->value, array_column($statusVisitEnum, 'value'));


                        for ($i = 0; $i <= $iterationStatusVisit; $i++) {
                            $visita->statusChanges()->create([
                                'status' => $statusVisitEnum[$i]->value,
                                'latitude' => $property->latitude,
                                'longitude' => $property->longitude,
                            ]);
                        }

                        Comment::factory(rand(2, 5))->create([
                            'commentable_id' => $visita->id,
                            'commentable_type' => 'App\Models\Visit',
                            'user_id' => User::where('business_id', $property->business_id)->inRandomOrder()->first()->id,
                        ]);
                    }
                });

                Phone::factory()->create([
                    'phoneable_id' => $customer->id,
                    'phoneable_type' => 'App\Models\Customer',
                ]);
            }
        }
    }
}
