<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Evaluasi extends Model
{
    use HasFactory;
    protected $table = "evaluasi";
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_lembaga',
        'id_docs',
        'temuan',
        'rtk',
        'tautan_rtk',
        'tautan_temuan',
        'status_docs',
        'status_pengisian',
        'score',
        'created_at',
        'updated_at',
        'deadline',
        'tgl_pengumpulan',
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

    // Definisikan relasi Many-to-One dengan Lembaga
    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class, 'id_lembaga', 'id');
    }

    public function dokumen()
    {
        return $this->hasOne(Dokumen::class, 'id_docs', 'id');
    }

}
