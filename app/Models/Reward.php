<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reward extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'reward_name',
        'price_incl_tax',
        'reward_description',
        'reward_image',
        'delivery_schedule',
        'project_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'delivery_schedule' => 'date',
        'price_incl_tax' => 'decimal:2'
    ];

    /**
     * Get the project that owns the reward.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the supports for the reward.
     */
    public function supports(): HasMany
    {
        return $this->hasMany(Support::class);
    }
}
