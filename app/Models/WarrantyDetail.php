<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarrantyDetail extends Model
{
    use HasFactory;

    protected $fillable = [

        'date_due',

        'discount',
        'price',
        'unit_value',
        'quantity',

        'total',

        'series',

        'warranty_id',
        'branch_product_id'
        
    ];

    protected $casts = [
        'series' => 'array'
    ];

    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }

    public function branchProduct()
    {
        return $this->belongsTo(BranchProduct::class);
    }

}
