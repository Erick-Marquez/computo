<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod',
        'name',
        'description',
        'price',
        'active',
        'brand_line_id'
    ];

    public function brandLine()
    {
        return $this->belongsTo(BrandLine::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    public function assemblies()
    {
        return $this->belongsToMany(Assembly::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
