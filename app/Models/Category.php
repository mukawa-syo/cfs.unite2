<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'project_categories';
    protected $primaryKey = 'project_category_id';

    protected $fillable = [
        'category_name'
    ];

    public function getNameAttribute()
    {
        return $this->category_name;
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'project_category_id', 'project_category_id');
    }
}
