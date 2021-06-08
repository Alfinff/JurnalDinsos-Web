<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'ms_users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'role',
        'uuid',
        'upt_id',
        'photo',
        'aktif',
        'users_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pendaftar()
    {
        return $this->hasMany('App\Models\Pendaftar', 'uuid','pj_id');
    }

    public function upt()
    {
        return $this->belongsTo('App\Models\Upt', 'upt_id','uuid');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role', 'id');
    }

    public function rolenya()
    {
        return $this->belongsTo('App\Models\Role', 'role', 'id');
    }

    public function module()
    {
        return $this->hasOne('App\Models\UsersModule', 'users_id', 'uuid');
    }

    public function profile()
    {
        return $this->hasOne('App\Models\UsersProfile', 'users_id', 'uuid');
    }

    public function title()
    {
        return $this->hasOne('App\Models\Pimpinan', 'users_id', 'uuid')->with('unitkerja');
    }
}
