<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranDetail extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran_detail';

    protected $fillable = [
        'id_pengeluaran',
        'id_akun',
        'keterangan',
        'total',
    ];

    public function Pengeluaran()
    {
        $this->belongsTo(Pengeluaran::class, 'id_pengeluaran');
    }

    public function Akun()
    {
        $this->belongsTo(Akun::class, 'id_akun');
    }
}
