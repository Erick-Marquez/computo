<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebitNoteType extends Model
{
    use HasFactory;

    protected $fillable = [
        'cod',
        'description'
    ];

    public function debitNotes()
    {
        return $this->hasMany(DebitNote::class);
    }
}
