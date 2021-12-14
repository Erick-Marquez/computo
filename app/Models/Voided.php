<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voided extends Model
{
    use HasFactory;

    protected $fillable = [

        'date_issue',
        'date_reference',

        'ticket_number',
        'identifier',
        'description',

        'state',
        'send_sunat',
        'response_sunat',
        'description_sunat_cdr',
        'hash_cdr',
        'hash_cpe',

        'sale_id',
        'user_id'
    ];


    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
