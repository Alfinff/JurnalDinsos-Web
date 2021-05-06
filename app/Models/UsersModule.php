<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModule extends Model
{
    use HasFactory;
    protected $table = 'ms_users_modul';
    protected $primaryKey = 'uuid';
    protected $casts = [
        'uuid' => 'string'
    ];
    protected $fillable = [
        'uuid',
        'master_kepegawaian',
        'kegiatan',
        'penerima_bantuan',
        'data_pendaftar',
        'data_upt',
        'master_pengguna',
    ];
}
