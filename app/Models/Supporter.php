<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supporter extends Model
{
    use HasFactory;

    protected $primaryKey = 'supporter_id';

    protected $fillable = [
        'user_id',
        'supporter_name',
        'address',
    ];

    // ユーザーとのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'supporter_id', 'supporter_id');
    }
}

        return $this->hasMany(Order::class, 'supporter_id', 'supporter_id');
    }
}

        return $this->hasMany(Order::class, 'supporter_id', 'supporter_id');
    }
}

        return $this->hasMany(Order::class, 'supporter_id', 'supporter_id');
    }
}

        return $this->hasMany(Order::class, 'supporter_id', 'supporter_id');
    }
}

        return $this->hasMany(Order::class, 'supporter_id', 'supporter_id');
    }
}
