<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = "dokumen";

    protected $fillable = [
        'judul',
        'tautan',
        'status_pengembalian',
        'id_lembaga',
        'status_docs',
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

    // Definisikan relasi Many-to-One dengan Lembaga
    public function lembaga()
    {
        return $this->belongsTo(Lembaga::class, 'id_lembaga', 'id');
    }

}
