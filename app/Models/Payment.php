<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $fillable = [
        'user_id',
        'plan_id',
        'price',
        'paid',
        'contact',
       'expiry_date',
       'is_paid',
    ];



    public function getIsPaidAttribute($value)
    {
        return $value == 1 ? 'Active' : 'InActive';
    }




    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plan(){
        return $this->belongsTo(Plan::class, 'plan_id');
    }
}

