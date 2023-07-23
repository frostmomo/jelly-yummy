<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturPenjualan extends Model
{
    use HasFactory;

    protected $table = 'retur_penjualan';

    protected $fillable = [
        'id_customer',
        'id_produk_jual',
        'subtotal',
    ];

    public function Customer() {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function ProdukJual() {
        return $this->belongsTo(ProdukJual::class, 'id_produk_jual');
    }

    public function Piutang() {
        return $this->hasMany(Piutang::class, 'id_retur_penjualan');
    }
}
