<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelCount extends Model
{
    use HasFactory;
   protected $fillable = ["modal_name","route_name","url","count"];

}
