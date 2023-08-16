<?php

namespace Database\Seeders;

use App\Models\Salesman;
use Illuminate\Database\Seeder;

class SalesmanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Salesman::create([
            'nama_salesman' => 'Yudi',
            'alamat_salesman' => 'Cimahi',
        ]);

        Salesman::create([
            'nama_salesman' => 'Sidik',
            'alamat_salesman' => 'Cimahi',
        ]);
    }
}
