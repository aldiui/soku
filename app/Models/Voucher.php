<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Voucher extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'voucher';

    protected $guarded = [
        'user_id',
        'nama',
        'deskripsi',
        'tipe',
        'diskon',
        'kuota',
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
