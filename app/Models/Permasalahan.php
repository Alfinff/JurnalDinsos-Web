<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permasalahan extends Model
{
    use HasFactory;
    protected $table = 'ms_permasalahan';
    protected $primaryKey = 'uuid';
    protected $casts = [
        'uuid' => 'string'
    ];
}
