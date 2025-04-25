<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'season'
    ];

    public function Clothes()
    {
        return $this->hasMany(Clothing::class, 'collection_id');
    }
}
