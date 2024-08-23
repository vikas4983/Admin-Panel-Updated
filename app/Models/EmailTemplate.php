<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'action', 'subject', 'status', 'body', 'demo2','demo3'];

    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }
    public function getActionAttribute($value)
    {
        return $value == 1 ? 'Admin' : 'User';
    }
}
