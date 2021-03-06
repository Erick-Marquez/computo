<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use ApiTrait, HasFactory;

    const ACEPTADO = 'ACEPTADO';
    const RECHAZADO = 'RECHAZADO';
    const PENDIENTE = 'PENDIENTE';
    const ANULADO = 'ANULADO';

    protected $fillable = [

        'document_number',
        'date_issue',
        'date_due',

        'global_discount',
        'item_discount',
        'total_discount',
        
        'subtotal',
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

        'serie_id',
        'customer_id',
        'open_closed_cashbox_id',
        'user_id'

    ];

    protected $allowIncluded = ['payment_types'];
    protected $allowFilter = ['id'];
    protected $allowSort = ['id', 'date_issue'];

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function voided()
    {
        return $this->hasOne(Voided::class);
    }

    public function quotation()
    {
        return $this->hasOne(Quotation::class);
    }

    public function warranty()
    {
        return $this->hasOne(Warranty::class);
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function paymentTypes()
    {
        return $this->belongsToMany(PaymentType::class)->withPivot(["amount"])->withTimestamps();
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

    public static function getSalesToday($date, $branch)
    {
        return Sale::whereDate('created_at', '>=', $date)->sum('total');

    }

}
