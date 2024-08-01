<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteConfig extends Model
{
    use HasFactory;
    public $fillable = ['interest_setting', 'profile_view_setting', 'profile_name_setting', 'profile_activation', 'profile_photo_setting', 'profile_kyc_setting', 'success_story_year_setting', 'male_legal_age', 'female_legal_age', 'status'];

    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }
    public function getInterestSettingAttribute($value)
    {
        return $value == 1 ? 'Paid User Can Send' : 'All User Can Send';
    }
    public function getProfileViewSettingAttribute($value)
    {
        return $value == 1 ? 'Paid User Can View' : 'All User Can View';
    }
    public function getProfileNameSettingAttribute($value)
    {
        return $value == 0 ? 'Show Full Name' : ($value == 1 ? 'Show Only First Name' : 'Hide Name');
    }
    public function getProfileActivationAttribute($value)
    {
        return $value == 1 ? 'Activate via Admin' : 'Activate vie OTP';
    }
    public function getProfilePhotoSettingAttribute($value)
    {
        return $value == 1 ? 'Mandatory' : 'Not-Mandatory';
    }
    public function getProfileKycSettingAttribute($value)
    {
        return $value == 1 ? 'Mandatory' : 'Not-Mandatory';
    }
    
}
