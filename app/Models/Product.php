<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod',
        'description',
        'price',
        'active',
        'brand_line_id'
    ];

    public function brandLine()
    {
        return $this->belongsTo(BrandLine::class);
    }
}
