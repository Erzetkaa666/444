<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = Barang::factory()->count(10)->create();

        // Buat activity awal untuk setiap barang yang disimpan lewat seeder
        foreach ($barangs as $barang) {
            Activity::create([
                'description' => "Menambah barang: {$barang->nama_barang}",
                'user_id' => null,
                'status' => 'created',
            ]);
        }
    }
}
