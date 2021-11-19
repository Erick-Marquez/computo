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
        'referential_purchase_price',
        'sale_price',
        'referential_sale_price_one',
        'referential_sale_price_two',
        'manager_series',
        'active',

        'have_warranty',
        'type_of_time_for_warranty',
        'time_of_warranty',

        'igv_type_id',
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

    public function igvType()
    {
        return $this->belongsTo(IgvType::class);
    }

    public function branchProductSeries()
    {
        return $this->hasMany(BranchProductSerie::class);
    }

    /**
     * * METODOS ESTATICOS DEL MODELO
    */

    public static function getNumberProductsBranch($branch_id)
    {
        return BranchProduct::where('branch_id', $branch_id)->count();
    }

}
