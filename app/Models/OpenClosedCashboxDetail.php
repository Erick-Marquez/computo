<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenClosedCashboxDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'observation',
        'type',
        'open_closed_cashbox_id'
    ];

    public function openClosedCashbox()
    {
        return $this->belongsTo(OpenClosedCashbox::class);
    }
}
