<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'category', 'description', 'price'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


}
