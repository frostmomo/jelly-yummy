<?php

namespace Database\Seeders;

use App\Models\KategoriJual;
use Illuminate\Database\Seeder;

class KategoriJualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        KategoriJual::create([
            'kategori_jual' => '140ML',
        ]);

        KategoriJual::create([
            'kategori_jual' => '250ML',
        ]);

        KategoriJual::create([
            'kategori_jual' => '340ML',
        ]);
    }
}
