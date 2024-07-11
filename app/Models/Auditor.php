<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Auditor extends Model
{
    use HasFactory;
    protected $table = "auditor";
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'foto',
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

}
