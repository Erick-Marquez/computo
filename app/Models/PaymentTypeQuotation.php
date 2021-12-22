<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PaymentTypeQuotation extends Pivot
{
    use HasFactory;

    protected $fillable = [

        'quotation_id',
        'payment_type_id',
        'amount'
        
    ];

    public function quotation()
    {   
        return $this->belongsTo(Quotation::class);
    }

    public function paymentType()
    {   
        return $this->belongsTo(PaymentType::class);
    }
}