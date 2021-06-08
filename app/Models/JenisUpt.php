<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisUpt extends Model
{
    use HasFactory;
    protected $table = 'ms_jenis_upt';
    protected $primaryKey = 'uuid';
    protected $keyType = 'uuid';
    protected $casts = [
        'uuid' => 'string'
    ];

    public function editornya()
    {
        return $this->hasOne('App\Models\User', 'uuid', 'editor');
    }
}
