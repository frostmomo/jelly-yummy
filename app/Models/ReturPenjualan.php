<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturPenjualan extends Model
{
    use HasFactory;

    protected $table = 'retur_penjualan';

    protected $fillable = [
        'id_penjualan_detail',
        'qty',
        'subtotal',
    ];

    //before
    // protected $fillable = [
    //     'id_penjualan',
    //     'id_customer',
    //     'id_produk_jual',
    //     'qty',
    //     'subtotal',
    // ];

    // public function Penjualan() {
    //     return $this->belongsTo(Penjualan::class, 'id_penjualan');
    // }

    // public function Customer() {
    //     return $this->belongsTo(Customer::class, 'id_customer');
    // }

    // public function ProdukJual() {
    //     return $this->belongsTo(ProdukJual::class, 'id_produk_jual');
    // }

    public function PenjualanDetail()
    {
        return $this->belongsTo(PenjualanDetail::class, 'id_penjualan_detail');
    }

    public function Piutang() 
    {
        return $this->hasMany(Piutang::class, 'id_retur_penjualan');
    }
}
