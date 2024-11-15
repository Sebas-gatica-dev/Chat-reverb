<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

beforeEach(function () {
    $this->user = User::factory()->create();
});


test('allows access if user has a business', function () {
    $this->actingAs($this->user);
    // Asigna un negocio al usuario
    $this->user->business()->create([
        'id' => 1,
        'name' => 'Test Business',
        'email' => 'sadsad@mail.com',
        'phone' => '1234567890',
        'address' => '123 Test St.',
        'creatyed_by' => $this->user->id


    ]);

    // Realiza una solicitud a la ruta protegida
    $response = $this->get('panel');

    // Verifica que el usuario pueda acceder a la ruta protegida
    $response->assertOk();
});
