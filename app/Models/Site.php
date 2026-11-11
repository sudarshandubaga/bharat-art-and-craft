<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'social_links' => 'array',
    ];

    public function getWhatsappUrlAttribute()
    {
        if (empty($this->whatsapp)) {
            return null;
        }
        $number = preg_replace('/[^0-9]/', '', $this->whatsapp);
        return 'https://wa.me/' . $number;
    }
}

