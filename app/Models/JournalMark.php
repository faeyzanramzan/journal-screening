<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalMark extends Model
{
    protected $fillable = [
        'journal_id',
        'section_2a',
        'section_2b',
        'section_2c',
        'section_2d',
        'section_2e',
        'section_3a',
        'section_3b',
        'section_3c',
        'section_3d',
        'section_4a',
        'section_4b',
    ];
}
