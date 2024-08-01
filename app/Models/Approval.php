<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;
    public $fillable = ['user_id', 'about_me', 'about_education', 'about_occupation', 'about_family', 'read_carefully', 'success_story',  'image1', 'image2', 'image3', 'image4', 'image5',  'image6','status'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function plans()
    {
        return $this->belongsTo(Plan::class);
    }
    
    public function profileid()
    {
        return $this->belongsTo(ProfileId::class);
    }
    public function successStory()
    {
        return $this->belongsTo(SuccessStory::class);
    }
   
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }
    public function getAboutMeAttribute($value)
    {
        return $value == 1 ? 'All User Can View' : 'Hide From All User';
    }
    public function getAboutEducationAttribute($value)
    {
        return $value == 1 ? 'All User Can View' : 'Hide From All User';
    }
    public function getAboutOccupationAttribute($value)
    {
        return $value == 1 ? 'All User Can View' : 'Hide From All User';
    }
    public function getAboutFamilyAttribute($value)
    {
        return $value == 1 ? 'All User Can View' : 'Hide From All User';
    }
    public function getReadCarefullyAttribute($value)
    {
        return $value == 1 ? 'All User Can View' : 'Hide From All User';
    }
    public function getSuccessStoryAttribute($value)
    {
        return $value == 1 ? 'All User Can View' : 'Hide From All User';
    }
    
    public function getImage1Attribute($value)
    {
        return $value == 1 ? 'All User Can View' : 'Hide From All User';
    }
    public function getImage2Attribute($value)
    {
        return $value == 1 ? 'All User Can View' : 'Hide From All User';
    }
    public function getImage3Attribute($value)
    {
        return $value == 1 ? 'All User Can View' : 'Hide From All User';
    }
    public function getImage4Attribute($value)
    {
        return $value == 1 ? 'All User Can View' : 'Hide From All User';
    }
    public function getImage5Attribute($value)
    {
        return $value == 1 ? 'All User Can View' : 'Hide From All User';
    }
    public function getImage6Attribute($value)
    {
        return $value == 1 ? 'All User Can View' : 'Hide From All User';
    }
    
}
