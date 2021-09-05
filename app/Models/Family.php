<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;
    protected $fillable = [
        'cod',
        'description',
        'active'
    ];

    public function lines()
    {
        return $this->hasMany(Line::class);
    }
}
