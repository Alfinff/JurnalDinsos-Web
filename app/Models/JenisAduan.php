<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAduan extends Model
{
    use HasFactory;
    protected $table = 'ms_jenis_aduan';
    protected $primaryKey = 'uuid';
    protected $casts = [
        'uuid' => 'string'
    ];

    protected $fillable   = [
        'nama',
    ];

    public function pendaftaran()
    {
        return $this->hasMany('App\Models\Pendaftaran', 'jenis_aduan','uuid');
    }
}
