<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'line_id'
    ];

    protected $table = 'brand_line';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function line()
    {
        return $this->belongsTo(Line::class);
    }
}
