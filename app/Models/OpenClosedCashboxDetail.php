<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenClosedCashboxDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'observation',
        'type',
        'open_closed_cashbox_id',
        'payment_type_id',
        'user_id',
    ];

    public function openClosedCashbox()
    {
        return $this->belongsTo(OpenClosedCashbox::class);
    }

    public function paymentDetail()
    {
        return $this->morphOne(PaymentDetail::class, 'payable');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
