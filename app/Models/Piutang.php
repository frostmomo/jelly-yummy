<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    use HasFactory;

    protected $table = 'piutang';

    protected $fillable = [
        'id_penjualan',
        'id_retur_penjualan',
        'bayar',
    ];

    public function Penjualan() {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }
    
    public function ReturPenjualan() {
        return $this->belongsTo(ReturPenjualan::class, 'id_retur_penjualan');
    }
}
