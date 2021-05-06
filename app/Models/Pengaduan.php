<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $table = 'pendaftaran';
    protected $fillable = [
        'nama_lengkap',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'umur',
        'jenis_kelamin',
        'no_hp',
        'prov_id',
        'kab_id',
        'kec_id',
        'alamat',
        'jenis_aduan',
        'upt_id',
        'nama_rekomendasi',
        'telp_rekomendasi',
        'foto_kondisi',
        'surat_pengantar'
    ];
}
