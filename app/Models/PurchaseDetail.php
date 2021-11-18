<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'series' => 'array'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function branchProduct()
    {
        return $this->belongsTo(BranchProduct::class);
    }

}
