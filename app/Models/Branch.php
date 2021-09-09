<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'phone',
        'direction',
        'ubigeo',
        'state',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function series()
    {
        return $this->hasMany(Serie::class);
    }

    public function branchProducts()
    {
        return $this->hasMany(BranchProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function cashboxes()
    {
        return $this->hasMany(Cashbox::class);
    }
}
