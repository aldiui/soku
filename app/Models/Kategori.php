<?php

namespace App\Models;

use App\Models\User;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'kategori';

    protected $fillable = [
        'nama',
    ];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
