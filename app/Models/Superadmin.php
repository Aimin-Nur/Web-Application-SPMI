<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class Superadmin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    Protected $table = 'superadmin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function formatTimestamp($timestamp){
        Carbon::setLocale('id');

        return Carbon::parse($timestamp)->translatedFormat('l, d F Y');
    }

    public function getCreatedAtAttribute($value){
        return $this->formatTimestamp($value);
    }

    public function getUpdatedAtAttribute($value){
        return $this->formatTimestamp($value);
    }

}
