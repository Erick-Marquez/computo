<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'description'
    ];

    public function sales()
    {
        return $this->belongsToMany(Sale::class)->withPivot(["amount"]);
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class);
    }
}
