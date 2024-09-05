<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestMenu extends Model
{
    use HasFactory;

     public function superManu(){
        return $this->belongsTo(TestMenu::class,'super_menu_id');
     } 
     public function manu(){
        return $this->hasMany(TestMenu::class, 'manu_id');
     } 
     public function subManu(){
        return $this->hasMany(TestMenu::class, 'sub_manu_id');
     } 


}
