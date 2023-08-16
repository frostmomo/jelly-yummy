<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturPembelian extends Model
{
    use HasFactory;

    protected $table = 'retur_pembelian';

    protected $fillable = [
        'id_pembelian',
        'id_supplier',
        'id_produk_beli',
        'subtotal',
    ];

    public function Pembelian() {
        return $this->belongsTo(Pembelian::class, 'id_pembelian');
    }

    public function Supplier() {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function ProdukBeli() {
        return $this->belongsTo(ProdukBeli::class, 'id_produk_beli');
    }
}
