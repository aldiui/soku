<?php
namespace App\Models;

use Filament\Panel;
use App\Models\User;
use App\Models\Banner;
use App\Models\Voucher;
use App\Models\Transaksi;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles, HasPanelShield, HasUuids;

    protected $fillable = [
        'name',
        'email',
        'password',
        'telepon',
        'alamat'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }
}
