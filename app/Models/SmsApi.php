<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsApi extends Model
{
    use HasFactory;

    public $fillable = ['api_id', 'api_password', 'sms_type', 'sms_encoding', 'sender', 'number', 'message', 'template_id', 'status', 'demo1', 'demo2', 'demo3', 'demo4'];

 public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }
}
