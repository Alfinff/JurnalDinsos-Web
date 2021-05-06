<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranBantuan extends Model
{
    use HasFactory;
    protected $table      = 'ms_pendaftaran_bantuan';
    protected $primaryKey = 'id';
    protected $casts = [
        'id' => 'string'
    ];
}
