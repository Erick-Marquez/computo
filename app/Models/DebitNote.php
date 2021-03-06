<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebitNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'document_number',
        'date_issue',
        'subtotal',
        'discount',
        'total_igv',
        'total_exonerated',
        'total_unaffected',
        'total_free',
        'total_taxed',
        'total',
        'observation',

        'send_sunat',
        'response_sunat',
        'description_sunat_cdr',
        'hash_cdr',
        'canceled',

        'serie_id',
        'sale_id',
        'debit_note_type_id',
        'open_closed_cashbox_id',
        'user_id'
    ];

    public function debitNoteDetails()
    {
        return $this->hasMany(DebitNoteDetail::class);
    }

    public function debitNoteType()
    {
        return $this->belongsTo(DebitNoteType::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
