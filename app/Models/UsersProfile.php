<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersProfile extends Model
{
    use HasFactory;
    protected $table = 'ms_users_profile';
    protected $primaryKey = 'id';
    protected $casts = [
        'id' => 'string'
    ];
}
