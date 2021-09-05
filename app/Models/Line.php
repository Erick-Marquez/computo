<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod',
        'description',
        'family_id',
        'active'
    ];

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }
    public function family()
    {
        return $this->belongsTo(Family::class);
    }
}
