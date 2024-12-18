<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyUpdate extends Model
{
    protected $fillable = ['department_id', 'user_id', 'content', 'file', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
