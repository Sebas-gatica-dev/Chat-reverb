<?php

use App\Models\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Broadcast::channel('budgets-channel.{budgetId}', function (User $user, $budgetId) {
//     // Implementa tu lógica de autorización
//     return (int) $user->id === (int) $budgetId;
// });
