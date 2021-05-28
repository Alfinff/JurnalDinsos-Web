<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiTerakhir extends Model
{
    use HasFactory;
    protected $table = 'ms_kondisi_terakhir';
    protected $primaryKey = 'id';
    protected $keyType = 'uuid';
    protected $casts = [
        'id' => 'string'
    ];
}
