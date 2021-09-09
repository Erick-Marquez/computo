<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssemblyProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'assembly_id',
        'product_id'
    ];

    protected $table = "assembly_product";
}
