<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('assets/img/fur_room_living.png');
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://') || str_starts_with($this->image, '//')) {
            return $this->image;
        }
        if (str_starts_with($this->image, 'assets/')) {
            return asset($this->image);
        }
        if (file_exists(public_path('images/blogs/' . $this->image))) {
            return asset('images/blogs/' . $this->image);
        }
        if (file_exists(public_path('assets/img/' . $this->image))) {
            return asset('assets/img/' . $this->image);
        }
        if (file_exists(public_path('images/' . $this->image))) {
            return asset('images/' . $this->image);
        }
        return asset('images/blogs/' . $this->image);
    }
}
