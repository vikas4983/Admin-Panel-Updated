<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class Admin extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;
    public $fillable = ['name', 'email', 'mobile','password','status','roll','image'];

    function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }
    function getRollAttribute($value)
    {
        return $value == 1 ? 'Admin' : 'Sub-Admin';
    }

    public function otps(){
        return $this->hasMany(MobileLogin::class, 'admin_id');
    }
}

// abc