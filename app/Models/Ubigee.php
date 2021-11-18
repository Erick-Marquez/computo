<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubigee extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'cod',
        'place_description'
    ];

    protected $allowIncluded = [];
    protected $allowFilter = ['place_descrition', 'cod'];
    protected $allowSort = ['id'];
}
