<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $fillable = [
        'id_supplier',
        'total_item',
        'subtotal',
        'diskon',
        'bayar',
    ];

    public function Supplier() {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function PembelianDetail() {
        return $this->hasMany(PembelianDetail::class, 'id_pembelian');
    }
}
