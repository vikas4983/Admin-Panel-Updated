<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Occupation extends Model
{
    use HasFactory;
    public $fillable = ['employee_id', 'occupation', 'status'];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }}
