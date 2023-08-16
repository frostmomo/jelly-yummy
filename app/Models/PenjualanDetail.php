<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;

    protected $table = 'penjualan_detail';

    protected $fillable = [
        'id_penjualan',
        'id_produk_jual',
        'qty',
        'total',
    ];

    public function Penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }

    public function ProdukJual()
    {
        return $this->belongsTo(ProdukJual::class, 'id_produk_jual', 'id');
    }
}
