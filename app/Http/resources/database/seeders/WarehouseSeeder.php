<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $business = Business::where('name','Protegel')->first();
        $user = User::where('email','dizeg@gmail.com')->first();


       Warehouse::create([
        'name' => 'Deposito 1',
        'address' => 'Direccion 1',
        'created_by' => $user->id,
        'business_id' => $business->id
       ]);
       Warehouse::create([
        'name' => 'Deposito 2',
        'address' => 'Direccion 2',
        'created_by' => $user->id,
        'business_id' => $business->id
       ]);
       Warehouse::create([
        'name' => 'Deposito 3',
        'address' => 'Direccion 3',
        'created_by' => $user->id,
        'business_id' => $business->id

       ]);
    }
}
