<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upt extends Model
{
    use HasFactory;
    protected $table = 'ms_upt';
    protected $fillable = [
        'nama',
        'alamat',
        'foto',
        'uuid',
    ];

    public function pegawai()
    {
        return $this->hasMany('App\Models\User', 'upt_id','uuid');
    }

    public function pendaftaran()
    {
        return $this->hasMany('App\Models\Pendaftaran', 'upt_id','uuid');
    }
}
