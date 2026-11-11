<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = ['image_url', 'thumbnail_url', 'category_name'];

    public function getCategoryNameAttribute()
    {
        return !empty($this->category) ? $this->category->title : 'N/A';
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function finish()
    {
        return $this->belongsTo(Finish::class, 'finish_id', 'id');
    }

    public function wood()
    {
        return $this->belongsTo(Wood::class, 'wood_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')->orderBy('sort_order', 'asc');
    }

    public function gallery()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')->orderBy('sort_order', 'asc');
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
        if (file_exists(public_path('images/products/' . $this->image))) {
            return asset('images/products/' . $this->image);
        }
        if (file_exists(public_path('assets/img/' . $this->image))) {
            return asset('assets/img/' . $this->image);
        }
        if (file_exists(public_path('images/' . $this->image))) {
            return asset('images/' . $this->image);
        }
        return asset('images/products/' . $this->image);
    }

    public function getThumbnailUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('assets/img/fur_new_sideboard.png');
        }
        if (file_exists(public_path('images/products/thumbnail/' . $this->image))) {
            return asset('images/products/thumbnail/' . $this->image);
        }
        return $this->image_url;
    }

    /**
     * Format into array compatible with front-end JS catalog (window.TFT_Products)
     */
    public function toFrontendArray(): array
    {
        $galleryUrls = $this->images->map(fn($img) => $img->image_url)->toArray();
        if (empty($galleryUrls)) {
            $galleryUrls = [$this->image_url];
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => (float)($this->price ?? 0),
            'cbm' => $this->cbm ?: '0.45',
            'category' => $this->category?->slug ?? 'lounge',
            'homeCategory' => 'living-room',
            'categoryLabel' => $this->category?->title ?? 'Furniture',
            'image' => $this->image_url,
            'gallery' => $galleryUrls,
            'wood' => $this->wood?->name ?? 'Solid Teak Wood',
            'finish' => $this->finish?->name ?? 'Natural Oil Finish',
            'w' => 80,
            'd' => 80,
            'h' => 75,
            'footprint' => ['w' => 80, 'd' => 80],
            'color' => 'hsl(36, 30%, 90%)',
            'planColor' => 'hsl(36, 30%, 90%)',
            'material' => $this->material ?? ($this->wood?->name ?? 'Solid Hardwood'),
            'origin' => 'Jodhpur, Rajasthan, India',
            'designer' => 'Bharat Art & Craft Master Artisan',
            'leadTime' => '2-4 Weeks',
            'swatches' => [$this->finish?->name ?? 'Natural Wood', 'Dark Smoked', 'Warm Teak'],
            'desc' => $this->excerpt ?: Str::limit(strip_tags($this->description ?? ''), 150),
            'description' => $this->description,
            'code' => $this->code,
            'quantity' => $this->quantity,
            'slug' => $this->slug,
            'url' => route('product.single', ['slug' => $this->slug]),
        ];
    }
}
