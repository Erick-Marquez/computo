<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    const ACEPTADO = 'ACEPTADO';
    const RECHAZADO = 'RECHAZADO';
    const PENDIENTE = 'PENDIENTE';
    const ANULADO = 'ANULADO';

    protected $fillable = [

        'document_number',
        'date_issue',
        'date_due',

        'subtotal',
        'discount',
        'total_igv',
        'total_exonerated',
        'total_unaffected',
        'total_free',
        'total_taxed',
        'total',

        'have_warranty',

        'observation',
        'received_money',
        'change',

        'state',
        'send_sunat',
        'response_sunat',
        'description_sunat_cdr',
        'hash_cdr',
        'hash_cpe',
        'canceled',

        'payment_type_id',
        'serie_id',
        'customer_id',
        'open_closed_cashbox_id',
        'user_id'

    ];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function warranty()
    {
        return $this->hasOne(Warranty::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function openClosedCashbox()
    {
        return $this->belongsTo(OpenClosedCashbox::class);
    }

    /**
     * * METODOS ESTATICOS DEL MODELO
    */

    public static function getSalesToday()
    {
        return Sale::where('date_issue', date('Y-m-d'))->sum('total');
    }
}
