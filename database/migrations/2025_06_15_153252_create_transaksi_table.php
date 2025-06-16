<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id')->nullable();
            $table->uuid('approval_id')->nullable();
            $table->uuid('voucher_id')->nullable();
            $table->string('kode_transaksi')->unique();
            $table->double('total_harga');
            $table->double('diskon')->default(0);
            $table->double('total_bayar');
            $table->text('catatan')->nullable();
            $table->enum('status', ['Baru', 'Diproses', 'Selesai', 'Dibatalkan']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
