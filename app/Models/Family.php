<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'cod',
        'description',
        'active'
    ];

    protected $allowFilter = ['id', 'cod', 'description'];
    protected $allowSort = ['id', 'cod', 'description', 'active'];
    protected $allowSearch = ['cod', 'description'];

    public function lines()
    {
        return $this->hasMany(Line::class);
    }
}
