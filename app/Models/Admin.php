<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function getNameAttribute()
    {
        return trim(($this->title ?? '') . ' ' . ($this->first_name ?? '') . ' ' . ($this->last_name ?? ''));
    }
}

