<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgvType extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod',
        'description'
    ];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
