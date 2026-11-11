<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Wood extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'woods';

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'wood_id');
    }

    public function getSlugAttribute($value)
    {
        return $value ?: Str::slug($this->name);
    }
}
