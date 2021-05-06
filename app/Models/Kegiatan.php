<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'ms_kegiatan';
    protected $primaryKey = 'id';
    protected $keyType = 'uuid';
    protected $casts = [
        'id' => 'string'
    ];

}
