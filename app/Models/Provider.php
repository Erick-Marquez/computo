<?php

namespace App\Models;

use App\Http\Requests\ProviderRequest;
use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'name',
        'document',
        'tradename',
        'phone',
        'email',
        'address',
        'ubigee_id',
        'identification_document_id'
    ];

    protected $allowIncluded = ['identificationDocument', 'ubigee'];
    protected $allowFilter = ['id', 'document', 'tradename', 'identification_document_id'];
    protected $allowSort = ['id'];

    public function identificationDocument()
    {
        return $this->belongsTo(IdentificationDocument::class);
    }

    public function ubigee()
    {
        return $this->belongsTo(Ubigee::class);
    }

}
