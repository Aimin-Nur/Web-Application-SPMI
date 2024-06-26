<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class Lembaga extends Model
{
    use HasFactory;
    protected $table = 'lembaga';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_lembaga',
        'created_at',
        'updated_at',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate UUID for primary key
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id_lembaga', 'id');
    }

    // Relasi One-to-Many dengan model Dokumen
    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'id_lembaga', 'id');
    }

}
