<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendafoutlite extends Model
{
    use HasFactory;
    protected $casts = [
        'expired_at' => 'tanggal'
    ];
    protected $fillable = [
        'id_sales', 'tanggal', 'kodetoko', 'namatoko', 'pemiliktoko', 'alamat', 'domisili', 'no_telp', 'fotoktp', 'status'
    ];

    public function masterpegawai()
    {
        return $this->hasOne(Masterpegawai::class, 'id', 'id_sales');
    }
}
