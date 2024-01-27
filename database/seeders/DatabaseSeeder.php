<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// use App\Models\Masterpegawai;

use App\Models\Masterbarang;
use App\Models\User;
use App\Models\Mastertoko;
use App\Models\Masterpegawai;
use App\Models\Mastersupplier;
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

        Mastertoko::create([
            'kode' => 'TK1',
            'namatoko' => 'Toko Ibu Hani',
            'pemilik' => 'Hani Fitri',
            'alamat' => 'Banjarbaru'
        ]);

        Mastertoko::create([
            'kode' => 'TK2',
            'namatoko' => 'Toko Ibu Gelis',
            'pemilik' => 'Hj. Gelis',
            'alamat' => 'Liang Anggang'
        ]);

        Mastertoko::create([
            'kode' => 'TK3',
            'namatoko' => 'Toko Sembako Sejahterah',
            'pemilik' => 'Ibu Riska',
            'alamat' => 'Landasan Ulin'
        ]);

        Mastersupplier::create([
            'npwp' => '123456789012000',
            'namapt' => 'PT Indofood',
            'alamat' => 'Sudirman Plaza Indofood Tower',
            'email' => 'ptindofood@indofood.com',
            'no_telp' => '08553321234'
        ]);

        Masterbarang::create([
            'kodebarang' => 'TOD02B',
            'namabarang' => 'Tissue Dynasty Toilet 180G',
            'hargabarang' => '29000'
        ]);

    }
}
