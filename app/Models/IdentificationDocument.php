<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentificationDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description',
    ];

    protected $keyType = 'String';
    public $incrementing = false;

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function providers()
    {
        return $this->hasMany(Provider::class);
    }
}
