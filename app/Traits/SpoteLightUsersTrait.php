<?php

namespace App\Traits;

use App\Models\ProfileId;
use App\Models\SpoteLight;
use App\Models\User;
use Carbon\Carbon;

trait SpoteLightUsersTrait
{
    public function spotlightUsers()
    {
        $spoteLight = SpoteLight::with(['user' => function ($query) {
            $query->where('status', 1);
        }])
            ->latest('created_at')
            ->first(); // Use first() instead of take(1) to retrieve a single instance

        $currentDate = Carbon::now('Asia/Kolkata');
        if ($spoteLight) {
            // Dump or use the duration property
            if ($spoteLight->duration >= $currentDate) {
                return $spoteLight;
            } else {
                // Update is_spote_light to 0 for expired SpoteLight
                $isSpoteLight = SpoteLight::find($spoteLight->id);
                $isSpoteLight->update([
                    'is_spote_light' => 0
                ]);
            }
        }

        return $spoteLight; // Return the single SpoteLight instance or null
    }
}
