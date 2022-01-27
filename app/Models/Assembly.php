<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assembly extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'name',
        'cod',
        'description',
        'price',
        'active'
    ];

    protected $allowIncluded = ['products', 'image'];
    protected $allowFilter = ['id', 'name', 'active'];
    protected $allowSearch = ['name', 'cod'];
    protected $allowSort = ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'assembly_product', 'assembly_id', 'product_id')
                    ->withPivot('quantity', 'sale_price');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
