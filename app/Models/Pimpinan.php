<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    use HasFactory;
    protected $table = 'ms_pimpinan';
    protected $primaryKey = 'id_unit_kerja';
    protected $casts = [
        'id_unit_kerja' => 'string'
    ];

    protected $fillable = array(
        'id_unit_kerja',
        'users_id',
        'editor',
        'upt_id',
    );

    public function users()
    {
        return $this->hasOne('App\Models\User', 'uuid','users_id');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\UsersProfile', 'users_id','uuid');
    }

    public function unitkerja()
    {
        return $this->hasOne('App\Models\UnitKerja', 'id_unit_kerja','id_unit_kerja');
    }
}
