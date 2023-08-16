<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Customer::create([
            'nama_customer' => 'DEWI',
            'alamat_customer' => 'Sukajaya',
            'telepon_customer' => '081234597897',
        ]);

        Customer::create([
            'nama_customer' => 'UMMI',
            'alamat_customer' => 'Cibeureum',
            'telepon_customer' => '081237817897',
        ]);

        Customer::create([
            'nama_customer' => 'NURHASANAH',
            'alamat_customer' => 'Lembur Sawah',
            'telepon_customer' => '087894597897',
        ]);
    }
}
