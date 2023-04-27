<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id', 'category_id', 'price', 'discount_percentage', 'discounted_price'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
