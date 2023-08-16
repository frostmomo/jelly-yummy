<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;

    protected $table = 'pembelian_detail';

    protected $fillable = [
        'id_pembelian',
        'id_produk_beli',
        'qty',
        'total',
    ];

    public function Pembelian() {
        return $this->belongsTo(Pembelian::class, 'id_pembelian');
    }

    public function ProdukBeli() {
        return $this->belongsTo(ProdukBeli::class, 'id_produk_beli');
    }
}
