<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// use App\Models\Masterpegawai;
use App\Models\Masterpegawai;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DB::table('masterpegawais')->insert([
        //     'kode' => '1111',
        //     'nama' => 'Hendra',
        //     'no_telp' => '081999234478',
        // ]);

        // User Data
        User::create([
            'name' => 'supervisor',
            'email' => 'supervisor@gmail.com',
            'password' => bcrypt('1'),
            'roles' => 'supervisor'
        ]);

        User::create([
            'name' => 'sales',
            'email' => 'sales@gmail.com',
            'password' => bcrypt('2'),
            'roles' => 'sales'
        ]);

        //MasterData
        Masterpegawai::create([
            'kode' => '1111',
            'nama' => 'Hendra',
            'no_telp' => '081999234478'
        ]);
    }
}
