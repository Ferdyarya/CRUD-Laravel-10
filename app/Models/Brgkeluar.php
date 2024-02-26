<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brgkeluar extends Model
{
    use HasFactory;
    protected $casts = [
        'expired_at' => 'tanggal'
    ];
    protected $fillable = [
        'namabarang', 'qty', 'tanggal','alamat', 'id_pegawai','id_toko','id_barang'
    ];




    public function masterpegawai()
    {
        return $this->hasOne(Masterpegawai::class, 'id', 'id_pegawai');
    }

    public function mastertoko()
    {
        return $this->hasOne(Mastertoko::class, 'id', 'id_toko');
    }

    public function masterbarang()
    {
        return $this->hasOne(Masterbarang::class, 'id', 'id_barang');
    }
}
