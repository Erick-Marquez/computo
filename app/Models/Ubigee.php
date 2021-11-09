<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubigee extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod',
        'place_description'
    ];
}
