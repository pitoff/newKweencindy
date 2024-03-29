<?php

namespace App\Models;

use App\Enums\BookingStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // const UPDATED_AT = null;
    
    public $fillable = [
        'ref_no',
        'user_id',
        'category_id',
        'location',
        'state',
        'town',
        'address',
        'payment_status',
        'book_status',
        'book_date',
        'book_time'
    ];

    // protected $casts = [
    //     'payment_status' => BookingStatusEnum::class,
    //     'book_status' => BookingStatusEnum::class
    // ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getBookDateAttribute($bookDate)
    {
        return date('d-M-Y', strtotime($bookDate));
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }
}
