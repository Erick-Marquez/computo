<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_type',
        'document_number',
        'serie',
        'exchange_rate',
        'date_issue',
        'subtotal',
        'total_igv',
        'total',
        'observation',
        'provider_id',
        'open_closed_cashbox_id'
    ];
}
