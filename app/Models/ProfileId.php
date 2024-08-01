<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileId extends Model
{
    use HasFactory;
    public $fillable = ['name', 'status'];

    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'InActive';
    }
}
