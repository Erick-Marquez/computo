<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditNoteType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description'
    ];

    protected $keyType = 'String';
    public $incrementing = false;

    public function creditNotes()
    {
        return $this->hasMany(CreditNote::class);
    }
}
