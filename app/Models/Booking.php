<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    const UPDATED_AT = null;
    
    public $fillable = [
        'user_id',
        'category_id',
        'location',
        'state',
        'town',
        'address',
        'payment_status',
        'book_status',
        'book_date'
    ];

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
}
