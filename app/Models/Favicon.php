<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favicon extends Model
{
    use HasFactory;
    public $fillable= ['name', 'status'];
    
     function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }
}
