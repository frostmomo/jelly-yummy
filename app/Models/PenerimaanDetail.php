<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanDetail extends Model
{
    use HasFactory;

    protected $table = 'penerimaan_detail';

    protected $fillable = [
        'id_penerimaan',
        'id_akun',
        'keterangan',
        'total',
    ];

    public function Penerimaan()
    {
        $this->belongsTo(Penerimaan::class, 'id_penerimaan');
    }

    public function Akun()
    {
        $this->belongsTo(Akun::class, 'id_akun');
    }
}
