<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $table      = 'ms_pendaftaran';
    protected $primaryKey = 'id';
    protected $fillable   = [
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
        'surat_pengantar',
        'uuid',
        'tindakan',
        'pj_id'
    ];

    public function penanggungjawab()
    {
        return $this->hasOne('App\Models\User', 'uuid','pj_id');
    }

    public function upt()
    {
        return $this->belongsTo('App\Models\Upt', 'upt_id','uuid');
    }

    public function jenisaduan()
    {
        return $this->belongsTo('App\Models\JenisAduan', 'jenis_aduan','uuid');
    }

    public function jeniskelamin()
    {
        return $this->belongsTo('App\Models\JenisKelamin', 'jenis_kelamin','uuid');
    }

    public function kondisiterakhir()
    {
        return $this->belongsTo('App\Models\KondisiTerakhir', 'uuid','pendaftar_id');
    }

    public function permasalahanya()
    {
        return $this->belongsTo('App\Models\Permasalahan', 'permasalahan','uuid');
    }

    public function pendampinya()
    {
        return $this->hasOne('App\Models\User', 'uuid','pendamping');
    }
}
