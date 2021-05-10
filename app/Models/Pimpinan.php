<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    use HasFactory;
    protected $table = 'ms_pimpinan';
    protected $primaryKey = 'id';
    protected $casts = [
        'id' => 'string'
    ];

    public function users()
    {
        return $this->hasOne('App\Models\User', 'uuid','users_id');
    }

    public function unitkerja()
    {
        return $this->hasOne('App\Models\UnitKerja', 'id_unit_kerja','id_unit_kerja');
    }
}
