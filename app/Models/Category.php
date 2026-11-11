<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = ['image_url'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function getSlugAttribute($value)
    {
        return $value ?: Str::slug($this->title);
    }

    public function getNameAttribute()
    {
        return $this->title;
    }

    public function getMetaTitleAttribute()
    {
        return $this->seo_title ?: $this->title;
    }

    public function getMetaKeywordsAttribute()
    {
        return $this->seo_keywords;
    }

    public function getMetaDescriptionAttribute()
    {
        return $this->seo_description ?: Str::limit(strip_tags($this->description ?? ''), 160);
    }

    public static function getAllCategories()
    {
        return static::orderBy('title')->get();
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('assets/img/fp_table_oak_round.png');
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, '//')) {
            return $this->image;
        }
        if (str_starts_with($this->image, 'assets/')) {
            return asset($this->image);
        }
        if (file_exists(public_path('images/categories/' . $this->image))) {
            return asset('images/categories/' . $this->image);
        }
        if (file_exists(public_path('assets/img/' . $this->image))) {
            return asset('assets/img/' . $this->image);
        }
        return asset('assets/img/' . $this->image);
    }
}
