<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'status'];

    protected function statusText(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => $attributes['status'] == 1 ? 'Active' : 'Inactive',
        );
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function weeklyUpdates()
    {
        return $this->hasMany(WeeklyUpdate::class);
    }
}
