<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Dokumen extends Model
{
    use HasFactory;
    protected $table = "dokumen";
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'judul',
        'tautan',
        'status_pengembalian',
        'id_lembaga',
        'status_docs',
        'created_at',
        'updated_at',
        'score',
        'tgl_pengumpulan',
        'deadline',
    ];

    // protected function formatTimestamp($timestamp){
    //     Carbon::setLocale('id');

    //     return Carbon::parse($timestamp)->translatedFormat('l, d F Y');
    // }

    // public function getCreatedAtAttribute($value){
    //     return $this->formatTimestamp($value);
    // }

    // public function getUpdatedAtAttribute($value){
    //     return $this->formatTimestamp($value);
    // }

    // public function getTglPengumpulanAttribute($value){
    //     return $this->formatTimestamp($value);
    // }

    // public function getDeadlineAttribute($value){
    //     return $this->formatTimestamp($value);
    // }

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
