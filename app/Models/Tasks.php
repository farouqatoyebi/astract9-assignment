<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->hasOne(TaskCategories::class, 'id', 'category_id')->where('deleted', '0')->where('status', 'active');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->where('status', 'active');
    }
}
