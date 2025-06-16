<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kategori;
use App\Models\DetailTransaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'produk';

    protected $fillable = [
        'kategori_id',
        'nama',
        'deskripsi',
        'harga',
        'gambar',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }


}
