<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AssemblyProduct extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'sale_price',
        'assembly_id',
        'product_id'
    ];

    protected $table = "assembly_product";
}
