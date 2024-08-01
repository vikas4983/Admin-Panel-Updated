<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    public $fillable = ['image', 'name', 'duration', 'price', 'offer','offer_price','per_month', 'saving', 'allow_contact', 'chat', 'video_call', 'message', 'status'];
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }
    // public function setAttributeToLowercase($attributes, $value)
    // {
    //     foreach ($attributes as $attribute) {
    //         $this->attributes[$attribute] = strtolower($value);
    //     }
    // }
    
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function razorpays(){
        return $this->hasMany(RazorPay::class);
    }
}
