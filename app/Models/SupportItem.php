<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportItem extends Model
{
    use HasFactory;

    // 一括代入を許可するカラムを指定
    protected $fillable = [
        'project_id',
        'name',
        'price',
        'description',
    ];

    // Projectモデルとのリレーション
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
