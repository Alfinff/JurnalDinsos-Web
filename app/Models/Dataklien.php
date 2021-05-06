<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dataklien extends Model
{
    use HasFactory;
    protected $table = 'dataklien';
    protected $fillable = array(
        'nama',
        'tanggal_masuk',
        'tanggal_keluar',
        'nomor_registrasi',
        'tempat_lahir',
        'tanggal_lahir',
        'prov_id',
        'kab_id',
        'kec_id',
        'alamat',
        'owner_id'
    );
}
