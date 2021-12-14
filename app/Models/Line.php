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

    protected $allowIncluded = ['brands', 'family'];
    protected $allowFilter = ['id', 'cod', 'description'];
    protected $allowSort = ['id', 'cod', 'description', 'active'];


    public function brands()
    {
        return $this->belongsToMany(Brand::class)->withPivot(["id"]);;
    }
    

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

}
