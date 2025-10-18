<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Household extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'household_head_name',
        'household_number',
        'address',
        'total_members',
        'notes',
        'created_by',
        'updated_by',
    ];

    /**
     * Relationship: Citizens in this household
     */
    public function citizens(): HasMany
    {
        return $this->hasMany(Citizen::class);
    }

    /**
     * Relationship: User who created the household
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Relationship: User who last updated the household
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scope: Search by household number
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('household_number', 'like', "%{$search}%")
                     ->orWhere('household_head_name', 'like', "%{$search}%")
                     ->orWhere('address', 'like', "%{$search}%");
    }
}

