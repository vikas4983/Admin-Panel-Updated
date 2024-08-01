<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    public $fillable = ['income', 'status'];
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
     }
    }
