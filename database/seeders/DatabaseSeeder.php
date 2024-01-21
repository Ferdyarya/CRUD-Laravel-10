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
            'name' => 'Reza',
            'email' => 'supervisor@gmail.com',
            'password' => bcrypt('1'),
            'roles' => 'supervisor'
        ]);

        User::create([
            'name' => 'Hendra',
            'email' => 'hendra@gmail.com',
            'password' => bcrypt('2'),
            'roles' => 'sales'
        ]);
        User::create([
            'name' => 'Erwin',
            'email' => 'erwin@gmail.com',
            'password' => bcrypt('3'),
            'roles' => 'sales'
        ]);
        User::create([
            'name' => 'Hero',
            'email' => 'hero@gmail.com',
            'password' => bcrypt('4'),
            'roles' => 'sales'
        ]);

        //MasterData
        Masterpegawai::create([
            'kode' => 'MA1',
            'nama' => 'Hendra',
            'no_telp' => '082399234478'
        ]);
        Masterpegawai::create([
            'kode' => 'MA2',
            'nama' => 'Erwin',
            'no_telp' => '083399254321'
        ]);
        Masterpegawai::create([
            'kode' => 'MA3',
            'nama' => 'Hero',
            'no_telp' => '08599921234'
        ]);
    }
}
