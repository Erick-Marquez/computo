<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'unit_price',
        'total_igv',
        'subtotal',
        'total',
        'discount',
        'igv_type_id',
        'sale_id',
        'branch_product_id'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function branchProduct()
    {
        return $this->belongsTo(BranchProduct::class);
    }

    public function igvType()
    {
        return $this->belongsTo(IgvType::class);
    }

}
