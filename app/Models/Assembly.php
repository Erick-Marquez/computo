<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assembly extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stock',
        'description',
        'price',
        'active'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'assembly_product', 'assembly_id', 'product_id')
                    ->withPivot('quantity');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
