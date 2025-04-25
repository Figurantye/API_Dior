<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'collection_id'
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }
}
