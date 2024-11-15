<?php

use App\Helpers\Notifications;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

function getFeatureCount($featureName)
{
    $features = Cache::get('business-functions-' . auth()->user()->business_id . '-user-' . auth()->user()->id);
    foreach ($features as $feature) {
        if ($feature['slug'] === $featureName) {
            return $feature['count'];
        }
    }
    return 0;
}


function authorizeFeatureCount($featureName, $variableToCompare, $component)
{
    $features = Cache::get('business-functions-' . auth()->user()->business_id . '-user-' . auth()->user()->id);
    //  dd($features);
    $featureCount = 0;

    foreach ($features as $feature) {
        if ($feature['slug'] === $featureName) {
            $featureCount = $feature['count'];
            break; // Termina el bucle una vez que se encuentra el slug
        }
    }


    if (count($variableToCompare) >= $featureCount) {
        $component->dispatch('notification', [
            'message' => 'Con tu plan actual no puedes agregar más elementos',
            'type' => Notifications::icons('error')
        ]);

        return false;
    }

    return true;
}


function flushCacheBusinessFunctions($businessId)
{
    $prefix = 'business-functions-' . $businessId;

    // Buscar todas las claves que comienzan con el prefijo en la tabla de caché
    $cacheEntries = DB::table('cache')
        ->where('key', 'like', $prefix . '%')
        ->get();
    
    // Eliminar cada entrada encontrada
    foreach ($cacheEntries as $entry) {
        Cache::forget($entry->key);
    }
}

