<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id', 'booking_id', 'email', 'item_paid', 'amount', 'status', 'order_id', 'tranx_ref'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

}
