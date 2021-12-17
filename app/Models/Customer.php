<?php

namespace App\Models;

use App\Traits\ApiTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use ApiTrait, HasFactory;

    protected $fillable = [
        'name',
        'document',
        'phone',
        'email',
        'address',
        'ubigee_id',
        'identification_document_id'
    ];

    protected $allowIncluded = ['ubigee'];
    protected $allowFilter = ['id', 'document', 'name', 'identification_document_id'];
    protected $allowSort = ['id'];

    public function identificationDocument()
    {
        return $this->belongsTo(IdentificationDocument::class);
    }

    public function ubigee()
    {
        return $this->belongsTo(Ubigee::class);
    }

    // METODOS DE INSERCION A LA BD

    public static function createCustomer($request)
    {
        if (isset($request['ubigee_id'])) {
            $ubigee_id = Ubigee::findId($request['ubigee_id']);
            $request['ubigee_id'] = $ubigee_id;
        }

        $customer = Customer::create($request);
        return $customer;
    }
}
