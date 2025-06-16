<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'banner';

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'gambar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }  

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->check() ? auth()->user()->id : null;
        });

        static::updating(function ($model) {
            $model->user_id = auth()->check() ? auth()->user()->id : null;
        });
    }
}
