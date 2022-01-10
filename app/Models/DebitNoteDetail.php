<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebitNoteDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'unit_value',
        'total_igv',
        'subtotal',
        'total',
        'igv_type_id',
        'debit_note_id',
        'branch_product_id'
    ];

    public function debitNote()
    {
        return $this->belongsTo(DebitNote::class);
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
