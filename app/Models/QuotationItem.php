<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'moq' => 'integer',
        'price_usd' => 'decimal:2',
        'cbm' => 'decimal:3',
        'sort_order' => 'integer',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image)) {
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, '//')) {
                return $this->image;
            }
            if (file_exists(public_path('images/products/' . $this->image))) {
                return asset('images/products/' . $this->image);
            }
            if (file_exists(public_path($this->image))) {
                return asset($this->image);
            }
            return asset('images/products/' . $this->image);
        }

        if ($this->product && $this->product->image_url) {
            return $this->product->image_url;
        }

        return asset('assets/img/fur_new_sideboard.png');
    }
}
