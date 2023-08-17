<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukJual extends Model
{
    use HasFactory;

    protected $table = 'produk_jual';

    protected $fillable = [
        'id_kategori_jual',
        'nama_produk_jual',
        'kode_produk_jual',
        'harga_produksi',
        'harga_jual',
        'stok',
    ];

    public function KategoriJual() {
        return $this->belongsTo(KategoriJual::class, 'id_kategori_jual');
    }

    public function PenjualanDetail() {
        return $this->hasMany(PenjualanDetail::class, 'id_produk_jual');
    }

    // public function ReturPenjualan() {
    //     return $this->hasMany(ReturPenjualan::class, 'id_produk_jual');
    // }
}
