<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwilioSms extends Model
{
    use HasFactory;
    public $fillable = ['sid', 'token', 'from_number','message', 'status', 'demo1', 'demo2', 'demo3',];


    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }
}
