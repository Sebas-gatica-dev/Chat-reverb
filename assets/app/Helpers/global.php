<?php

use App\Helpers\Notifications;
use Illuminate\Support\Facades\Cache;

function getFeatureCount($featureName)
{
    $features = Cache::get('business-functions-' . auth()->user()->business_id);
    foreach ($features as $feature) {
        if ($feature['slug'] === $featureName) {
            return $feature['count'];
        }
    }
    return 0;
}


function authorizeFeatureCount($featureName, $variableToCompare, $component)
{
    $features = Cache::get('business-functions-' . auth()->user()->business_id);
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

