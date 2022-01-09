<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;

    protected $fillable = [

        'document_number',
        'date_issue',
        'date_due',

        'global_discount',
        'item_discount',
        'total_discount',
        'total',

        'serie_id',
        'sale_id',
        'customer_id',
        'user_id'

    ];

    public function warrantyDetails()
    {
        return $this->hasMany(WarrantyDetail::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
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
