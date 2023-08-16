<?php

namespace Database\Seeders;

use App\Models\KategoriBeli;
use Illuminate\Database\Seeder;

class KategoriBeliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        KategoriBeli::create([
            'kategori_beli' => 'PAK',
        ]);

        KategoriBeli::create([
            'kategori_beli' => 'KTN',
        ]);

        KategoriBeli::create([
            'kategori_beli' => 'MTR',
        ]);

        KategoriBeli::create([
            'kategori_beli' => 'LBR',
        ]);

        KategoriBeli::create([
            'kategori_beli' => 'PCS',
        ]);
    }
}
