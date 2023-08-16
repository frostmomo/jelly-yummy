<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Supplier::create([
            'nama_supplier' => 'PULAU PLASTIK',
            'alamat_supplier' => 'Cijerah',
            'telepon_supplier' => '082462478312',
        ]);

        Supplier::create([
            'nama_supplier' => 'WIJAYA PLASTIK',
            'alamat_supplier' => 'Cijerah',
            'telepon_supplier' => '082462457891',
        ]);
        
        Supplier::create([
            'nama_supplier' => 'INDOWATER',
            'alamat_supplier' => 'Cimahi',
            'telepon_supplier' => '082462475912',
        ]);
    }
}
