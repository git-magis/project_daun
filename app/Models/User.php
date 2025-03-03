<?php

namespace App\Models;
use Carbon\Carbon;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Enable timestamps (this is the default)
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pohons()
    {
        return $this->hasMany(Pohon::class);
    }
    
    public function bungas()
    {
        return $this->hasMany(Pohon::class);
    }
}
