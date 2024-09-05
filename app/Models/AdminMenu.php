<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AdminMenu extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id', 'model_name', 'url', 'count', 'icon', 'status'];

    protected $with = ['children'];
    function getStatusAttribute($value)
    {
        return $value == 1 ? 'Active' : 'Inactive';
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(AdminMenu::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(AdminMenu::class, 'parent_id', 'id');
    }
    public function childrenRecursive(): HasMany
    {
        return $this->children()->with('childrenRecursive');
    }
}
