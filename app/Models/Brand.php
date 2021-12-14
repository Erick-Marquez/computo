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

    protected $allowIncluded = ['lines'];
    protected $allowFilter = ['id', 'cod', 'description'];
    protected $allowSort = ['id', 'cod', 'description', 'active'];

    public function lines()
    {
        return $this->belongsToMany(Line::class);
    }
}
