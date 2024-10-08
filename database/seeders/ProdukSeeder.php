<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('produks')->insert([
            [
                'nama' => 'Produk 1',
                'jenis' => 'Elektronik',
                'deskripsi' => 'Deskripsikan untuk Produk 1',
                'harga_jual' => 10000000.00,
                'harga_beli' => 8000000.00,
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Produk 2',
                'jenis' => 'Pakaian',
                'deskripsi' => 'Deskripsikan untuk Produk 2',
                'harga_jual' => 200000.00,
                'harga_beli' => 150000.00,
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),

            ],

            [
                'nama' => 'Produk 3',
                'jenis' => 'Peralatan Rumah Tangga',
                'deskripsi' => 'Deskripsikan untuk Produk 3',
                'harga_jual' => 300000.00,
                'harga_beli' => 250000.00,
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),

            ],
        ]);
    }
}
