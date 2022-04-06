<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockModification extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [

        'observation',
        'date',

        'quantity',
        'operation',
        'series',

        'branch_product_id',
        'branch_id',
        'user_id'

    ];

    protected $allowIncluded = [];
    protected $allowFilter = [];
    protected $allowSort = ['id', 'date'];

    protected $casts = [
        'series' => 'array'
    ];

    public function branchProduct()
    {
        return $this->belongsTo(BranchProduct::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
