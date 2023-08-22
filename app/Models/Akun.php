<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;

    protected $table = 'akun';

    protected $fillable = [
        'nama_akun',
        'kelompok_akun',
        'kode_akun',
    ];

    public function PenerimaanDetail()
    {
        $this->hasMany(PenerimaanDetail::class, 'id_akun');
    }

    public function PengeluaranDetail()
    {
        $this->hasMany(PengeluaranDetail::class, 'id_akun');
    }
}
