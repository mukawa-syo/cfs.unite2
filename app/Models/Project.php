<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reward;
use App\Models\User;
use App\Models\ProjectCategory;
use App\Models\ProjectUpdate;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    protected $primaryKey = 'id';

    // 旧フォーム名（project_name, target_pledge_amount）も受け付けるために含める
    protected $fillable = [
        'title',
        'description',
        'project_image',
        'goal_amount',
        'deadline',
        'project_category_id',
        'user_id',
        'status',
        'is_featured',
        // virtual (from legacy form)
        'project_name',
        'target_pledge_amount',
        'target_amount',
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_featured' => 'boolean',
        'goal_amount' => 'decimal:2',
    ];

    protected $appends = ['image_url'];

    /*** ---- Legacy 名称を DB 列へマップする Mutators ---- ***/
    // project_name -> title
    public function setProjectNameAttribute($value)
    {
        $this->attributes['title'] = $value;
    }
    // target_pledge_amount -> goal_amount
    public function setTargetPledgeAmountAttribute($value)
    {
        $this->attributes['goal_amount'] = $value;
    }
    // target_amount（フォーム側の名前） -> goal_amount
    public function setTargetAmountAttribute($value)
    {
        $this->attributes['goal_amount'] = $value;
    }

    /** スコープ：有効なプロジェクトのみ */
    public function scopeActive($query)
    {
        return $query->where('deadline', '>=', now()->startOfDay());
    }

    /** プロジェクトが有効かどうか */
    public function isActive()
    {
        return $this->deadline >= now()->startOfDay();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id', 'project_category_id');
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class);
    }

    public function updates()
    {
        return $this->hasMany(ProjectUpdate::class);
    }

    public function supporters()
    {
        return $this->belongsToMany(User::class, 'supports', 'project_id', 'user_id')
            ->withTimestamps()
            ->withPivot('amount');
    }

    public function supports()
    {
        return $this->hasMany(\App\Models\Support::class, 'project_id', 'id');
    }

    /** 合計支援額 */
    public function getTotalPledgeAmountAttribute()
    {
        return (float) $this->supports()->sum('amount');
    }

    /** 支援者数 */
    public function getTotalBackersAttribute()
    {
        return (int) $this->supports()->distinct('user_id')->count('user_id');
    }

    /** 進捗率（%） */
    public function getProgressPercentageAttribute()
    {
        $goal = (float) ($this->goal_amount ?? 0);
        if ($goal <= 0) {
            return 0;
        }
        $percentage = ($this->total_pledge_amount / $goal) * 100;
        return min(100, round($percentage, 1)); // 小数点第1位まで表示
    }

    /** 期限までの日数 */
    public function getRemainingDaysAttribute()
    {
        return max(0, now()->diffInDays($this->deadline, false));
    }

    /** 画像URL（ストレージから取得、または外部URL） */
    public function getImageUrlAttribute()
    {
        $imagePath = $this->getAttribute('project_image');
        if (!$imagePath) {
            return null;
        }
        
        // 外部URL（http/https）の場合はそのまま返す
        if (str_starts_with($imagePath, 'http')) {
            return $imagePath;
        }
        
        // ローカルファイルの場合はstorage/パスを返す
        return asset('storage/' . $imagePath);
    }

    /** 互換アクセサ: project_name -> title */
    public function getProjectNameAttribute()
    {
        return $this->title;
    }

    /** 互換アクセサ: target_pledge_amount -> goal_amount */
    public function getTargetPledgeAmountAttribute()
    {
        return $this->goal_amount;
    }
}
