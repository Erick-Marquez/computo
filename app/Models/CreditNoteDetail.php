<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditNoteDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'unit_price',
        'total_igv',
        'subtotal',
        'total',
        'discount',
        'igv_type_id',
        'credit_note_id',
        'branch_product_id'
    ];

    public function creditNote()
    {
        return $this->belongsTo(CreditNote::class);
    }

    public function branchProduct()
    {
        return $this->belongsTo(BranchProduct::class);
    }

    public function igvType()
    {
        return $this->belongsTo(IgvType::class);
    }
}
