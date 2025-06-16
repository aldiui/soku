<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Aldi Jaya Mulyana',
            'email' => 'admin@gmail.com',
            'password' => '11221122',
        ]);

        $bucket = Kategori::create([
            'nama' => 'Bucket',
        ]);
        
        $kue = Kategori::create([
            'nama' => 'Kue',
        ]);

        // Data Produk
        $products = [
            'bucket' => [
                [
                    'nama' => 'Bucket Bunga',
                    'deskripsi' => 'Rangkaian bucket bunga segar dengan desain menarik',
                    'harga' => [120000, 150000, 100000, 100000]
                ],
                [
                    'nama' => 'Bucket Uang',
                    'deskripsi' => 'Bucket uang kreatif untuk kado spesial',
                    'harga' => [50000, 75000, 50000, 100000]
                ],
                [
                    'nama' => 'Bucket Boneka Uang',
                    'deskripsi' => 'Kombinasi bucket boneka dan uang yang unik',
                    'harga' => [90000, 85000, 100000, 85000]
                ],
                [
                    'nama' => 'Bucket Snack',
                    'deskripsi' => 'Bucket berisi aneka snack pilihan',
                    'harga' => [30000, 30000, 80000, 50000]
                ]
            ],
            'kue' => [
                [
                    'nama' => 'Kue Ultah Lingkaran',
                    'deskripsi' => 'Kue ulang tahun berbentuk lingkaran dengan hiasan menarik',
                    'harga' => [100000, 110000, 50000, 50000]
                ],
                [
                    'nama' => 'Kue Ultah Kotak',
                    'deskripsi' => 'Kue ulang tahun berbentuk kotak dengan desain elegan',
                    'harga' => [100000, 150000, 250000, 200000]
                ],
                [
                    'nama' => 'Kue Ultah Anak',
                    'deskripsi' => 'Kue ulang tahun khusus anak-anak dengan desain karakter lucu',
                    'harga' => [100000, 250000, 100000, 200000]
                ]
            ]
        ];

        // Membuat produk bucket
        foreach ($products['bucket'] as $product) {
            foreach ($product['harga'] as $key => $harga) {
                Produk::create([
                    'kategori_id' => $bucket->id,
                    'nama' => $product['nama'] . ' Paket ' . ($key + 1),
                    'deskripsi' => $product['deskripsi'] . ' - Paket ' . ($key + 1),
                    'harga' => $harga
                ]);
            }
        }

        // Membuat produk kue
        foreach ($products['kue'] as $product) {
            foreach ($product['harga'] as $key => $harga) {
                Produk::create([
                    'kategori_id' => $kue->id,
                    'nama' => $product['nama'] . ' Paket ' . ($key + 1),
                    'deskripsi' => $product['deskripsi'] . ' - Paket ' . ($key + 1),
                    'harga' => $harga
                ]);
            }
        }
    }
}
