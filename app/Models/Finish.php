<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Finish extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'finishes';

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class, 'finish_id');
    }

    public function getSlugAttribute($value)
    {
        return $value ?: Str::slug($this->name);
    }
}
