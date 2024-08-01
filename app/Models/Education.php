<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    public $fillable = ['education', 'status'];
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }}
