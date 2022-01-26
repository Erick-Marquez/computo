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
        'slug',
        'name',
        'description',
        'referential_purchase_price',
        'sale_gain_one',
        'sale_gain_two',
        'sale_gain_three',
        'manager_series',
        'active',

        'have_warranty',
        'type_of_time_for_warranty',
        'time_of_warranty',

        'igv_type_id',
        'brand_id',
        'line_id'
    ];

    protected $allowIncluded = ['brand', 'line'];
    protected $allowFilter = ['id', 'name', 'cod'];
    protected $allowSearch = ['name', 'cod', 'slug'];
    protected $allowSort = ['id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function line()
    {
        return $this->belongsTo(Line::class);
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

    public function branchProductSeries()
    {
        return $this->hasManyThrough(BranchProductSerie::class, BranchProduct::class);
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
