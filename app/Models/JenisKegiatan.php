<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKegiatan extends Model
{
    use HasFactory;
    protected $table = 'ms_jenis_kegiatan';
    protected $primaryKey = 'uuid';
    protected $casts = [
        'uuid' => 'string'
    ];

    public function editornya()
    {
        return $this->hasOne('App\Models\User', 'uuid', 'editor');
    }
}
