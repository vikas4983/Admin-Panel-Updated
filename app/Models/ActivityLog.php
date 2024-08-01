<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{

    use HasFactory;
    public $fillable = ['admin_id', 'action', 'description'];
}
