<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpoteLight extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'duration', 'is_spote_light'];

    public function getIsSpoteLightAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
