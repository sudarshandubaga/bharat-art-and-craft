<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'date' => 'date',
        'valid_until' => 'date',
        'total_cbm' => 'decimal:3',
        'total_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function items()
    {
        return $this->hasMany(QuotationItem::class, 'quotation_id')->orderBy('sort_order', 'asc');
    }

    /**
     * Generate unique quotation number (e.g. QT-2026-0001)
     */
    public static function generateQuotationNo(): string
    {
        $year = date('Y');
        $prefix = "QT-{$year}-";
        
        $latest = self::withTrashed()
            ->where('quotation_no', 'like', "{$prefix}%")
            ->orderBy('id', 'desc')
            ->first();

        if ($latest) {
            $lastNum = (int)substr($latest->quotation_no, strlen($prefix));
            $nextNum = $lastNum + 1;
        } else {
            $nextNum = 1;
        }

        return $prefix . str_pad($nextNum, 4, '0', STR_PAD_LEFT);
    }
}
