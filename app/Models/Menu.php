<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    public $fillable = ['name', 'status','url','section'];
    
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }
    public function getSectionAttribute($value)
    {
        return $value == 1 ? 'Header' : 'Footer';
    }
    
}

