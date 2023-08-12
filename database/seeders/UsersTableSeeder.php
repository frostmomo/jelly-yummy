<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@argon.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('Owner'),
            'level' => 'owner',
        ]);

        User::create([
            'name' => 'Admin Kas',
            'email' => 'adminkas@gmail.com',
            'password' => Hash::make('adminkas'),
            'level' => 'Admin Kas',
        ]);

        User::create([
            'name' => 'Admin Penjualan',
            'email' => 'adminpenjualan@gmail.com',
            'password' => Hash::make('adminpenjualan'),
            'level' => 'Admin Penjualan',
        ]);
    }
}
