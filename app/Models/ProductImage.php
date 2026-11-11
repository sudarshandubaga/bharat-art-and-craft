<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['image_url'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('assets/img/fur_new_sideboard.png');
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, '//')) {
            return $this->image;
        }
        if (str_starts_with($this->image, 'assets/')) {
            return asset($this->image);
        }
        if (file_exists(public_path('images/products/gallery/' . $this->image))) {
            return asset('images/products/gallery/' . $this->image);
        }
        if (file_exists(public_path('images/products/' . $this->image))) {
            return asset('images/products/' . $this->image);
        }
        if (file_exists(public_path('assets/img/' . $this->image))) {
            return asset('assets/img/' . $this->image);
        }
        return asset('images/products/gallery/' . $this->image);
    }
}
