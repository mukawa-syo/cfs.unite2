<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    const PAYMENT_PENDING = 0;
    const PAYMENT_COMPLETED = 1;

    use HasFactory;

    protected $primaryKey = 'order_id';
    public $incrementing = true;
    protected $keyType = 'integer';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'order_date',
        'last_name',
        'first_name',
        'last_name_kana',
        'first_name_kana',
        'phone_number',
        'email',
        'postal_code',
        'prefecture',
        'city',
        'address',
        'building_name',
        'terms_agreement',
        'payment_status',
        'charge_id',
        'session_id',
        'user_id',
        'supporter_id',
        'amount',
        'project_id',
        'reward_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'terms_agreement' => 'boolean',
        'amount' => 'decimal:2',
        'payment_status' => 'integer'
    ];

    /**
     * Get the project that owns the order.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Set the payment status attribute.
     *
     * @param mixed $value
     * @return void
     */
    public function setPaymentStatusAttribute($value)
    {
        $this->attributes['payment_status'] = ($value === 'pending') ? 0 : $value;
    }

    /**
     * Get the user that owns the order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reward for this order.
     */
    public function reward(): BelongsTo
    {
        return $this->belongsTo(Reward::class, 'reward_id', 'reward_id');
    }
}
