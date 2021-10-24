<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'name',
        'document',
        'comercial_name',
        'phone',
        'email',
        'address',
        'identification_document_id'
    ];

    protected $allowIncluded = [];
    protected $allowFilter = ['id', 'document', 'comercial_name', 'identification_document_id'];
    protected $allowSort = ['id'];

    public function identificationDocument()
    {
        return $this->belongsTo(IdentificationDocument::class);
    }

}
