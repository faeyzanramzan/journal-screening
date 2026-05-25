<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = [
        'name',
        'website',
        'publisher',
        'issn',
        'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
