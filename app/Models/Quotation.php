<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [

        'document_number',
        'date_due',

        'subtotal',
        'discount',
        'total_igv',
        'total_exonerated',
        'total_unaffected',
        'total_free',
        'total_taxed',
        'total',

        'have_warranty',

        'observation',

        'payment_type_id',
        'serie_id',
        'customer_id',
        'user_id'
        
    ];

    public function quotationDetails()
    {
        return $this->hasMany(QuotationDetail::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
