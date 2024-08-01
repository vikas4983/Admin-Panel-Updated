<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;
    public $fillable = ['religion', 'status'];
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }}
