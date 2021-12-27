<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'cod',
        'description',
        'active'
    ];

    protected $allowIncluded = ['products'];
    protected $allowFilter = ['id', 'cod', 'description'];
    protected $allowSort = ['id', 'cod', 'description', 'active'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
