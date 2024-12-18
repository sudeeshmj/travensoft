<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class WeeklyUpdate extends Model
{
    protected $fillable = ['department_id', 'user_id', 'content', 'file', 'status'];

    protected $appends = ['formatted_created_at'];
    protected function formattedCreatedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->created_at->format('d-m-Y'),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
