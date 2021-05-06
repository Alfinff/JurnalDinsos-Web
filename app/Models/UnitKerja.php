<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    use HasFactory;
    protected $table = 'ms_unit_kerja';
    protected $primaryKey = 'id_unit_kerja';
    protected $casts = [
        'id_unit_kerja' => 'string'
    ];
}
