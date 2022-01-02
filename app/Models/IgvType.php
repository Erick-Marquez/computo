<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IgvType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description'
    ];

    protected $keyType = 'String';
    public $incrementing = false;

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }
}
