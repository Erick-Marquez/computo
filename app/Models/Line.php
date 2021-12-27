<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'cod',
        'description',
        'family_id',
        'active'
    ];

    protected $allowIncluded = ['family', 'products'];
    protected $allowFilter = ['id', 'cod', 'description'];
    protected $allowSort = ['id', 'cod', 'description', 'active'];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
