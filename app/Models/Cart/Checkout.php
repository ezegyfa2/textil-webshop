<?php

namespace App\Models\Cart;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Checkout extends Model
{
    protected $fillable = [
        'cart_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'company_name',
        'address',
        'postal_code',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}
