<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = 'ms_video';
    protected $primaryKey = 'uuid';
    protected $casts = [
        'uuid' => 'string'
    ];

    public function editornya()
    {
        return $this->hasOne('App\Models\User', 'uuid', 'editor');
    }
}
