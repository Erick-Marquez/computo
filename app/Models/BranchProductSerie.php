<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchProductSerie extends Model
{
    use HasFactory;

    protected $fillable = [
        //'cod',
        'serie',
        'sold',
        'active',
        'branch_product_id'
    ];

    public function branchProduct()
    {
        return $this->belongsTo(BranchProduct::class);
    }
}
