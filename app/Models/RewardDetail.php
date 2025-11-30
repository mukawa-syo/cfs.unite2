<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardDetail extends Model
{
    protected $primaryKey = 'reward_detail_id';

    protected $fillable = [
        'reward_id',
        'reward_name',
        'name',
        'detail',
        'color',
    ];
}
