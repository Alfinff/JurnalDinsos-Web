<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKelamin extends Model
{
    use HasFactory;
    protected $table = 'ms_jenis_kelamin';
    protected $primaryKey = 'uuid';
    protected $casts = [
        'uuid' => 'string'
    ];
}
