<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'discount',
        'total',
        'quotation_id',
        'branch_product_id'
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function branchProduct()
    {
        return $this->belongsTo(BranchProduct::class);
    }
}
