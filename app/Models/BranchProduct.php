<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        //'cod',
        'stock',
        'price',
        'manager_series',
        'active',
        'branch_id',
        'product_id',
    ];

    protected $table = "branch_product";

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function branchProductSeries()
    {
        return $this->hasMany(BranchProductSerie::class);
    }
}
