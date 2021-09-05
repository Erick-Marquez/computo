<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document',
        'comercial_name',
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
