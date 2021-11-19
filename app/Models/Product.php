<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'cod',
        'name',
        'description',
        'referential_purchase_price',
        'referential_sale_price',
        'referential_sale_price_one',
        'referential_sale_price_two',
        'manager_series',
        'active',

        'have_warranty',
        'type_of_time_for_warranty',
        'time_of_warranty',
        
        'igv_type_id',
        'brand_line_id'
    ];

    protected $allowIncluded = [];
    protected $allowFilter = ['id', 'name'];
    protected $allowSort = ['id'];

    public function brandLine()
    {
        return $this->belongsTo(BrandLine::class);
    }

    public function igvType()
    {
        return $this->belongsTo(IgvType::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    public function branchProducts()
    {
        return $this->hasMany(BranchProduct::class);
    }

    public function assemblies()
    {
        return $this->belongsToMany(Assembly::class);
    }

    public function quotationDetails()
    {
        return $this->hasMany(QuotationDetail::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
