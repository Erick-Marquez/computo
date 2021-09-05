<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document',
        'phone',
        'email',
        'address',
        'identification_document_id'
    ];

    public function identificationDocument()
    {
        return $this->belongsTo(IdentificationDocument::class);
    }
}
