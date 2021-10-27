<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_number',
        'discount',
        'total',
        'observation',

        'have_warranty',

        'date_due',
        
        'customer_id',
        'user_id'
    ];

    public function quotationDetails()
    {
        return $this->hasMany(QuotationDetail::class);
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
