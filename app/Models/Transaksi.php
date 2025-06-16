<?php

namespace App\Models;

use App\Models\User;
use App\Models\Voucher;
use App\Models\DetailTransaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'approval_id',
        'voucher_id',
        'kode_transaksi',
        'total_harga',
        'diskon',
        'total_bayar',
        'catatan',
        'status',
    ];

    public function approval()
    {
        return $this->belongsTo(User::class, 'approval_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
