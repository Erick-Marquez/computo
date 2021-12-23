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

        'sale_id',
        'serie_id',
        'customer_id',
        'user_id'
        
    ];

    public function quotationDetails()
    {
        return $this->hasMany(QuotationDetail::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function paymentTypes()
    {
        return $this->belongsToMany(PaymentType::class)->withPivot(['id', 'amount'])->using(PaymentTypeQuotation::class)->withTimestamps();
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
