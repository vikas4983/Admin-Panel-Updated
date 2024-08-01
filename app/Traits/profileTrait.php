<?php

namespace App\Traits;

use App\Models\ProfileId;

trait ProfileTrait
{
    public function profilePrefix()
    {
        $profilePrefixs = ProfileId::orderBy('created_at', 'desc')->get();
        return $profilePrefixs;
    }
}
