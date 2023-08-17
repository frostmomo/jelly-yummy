<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukBeli extends Model
{
    use HasFactory;

    protected $table = 'produk_beli';

    protected $fillable = [
        'id_kategori_beli',
        'nama_produk_beli',
        'kode_produk_beli',
        'harga_beli',
        'stok',
    ];

    public function KategoriBeli() {
        return $this->belongsTo(KategoriBeli::class, 'id_kategori_Beli');
    }

    public function PembelianDetail() {
        return $this->hasMany(PembelianDetail::class, 'id_produk_Beli');
    }

    // public function ReturPembelian() {
    //     return $this->hasMany(ReturPembelian::class, 'id_produk_beli');
    // }
}
