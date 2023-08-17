<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';

    protected $fillable = [
        'nama_supplier',
        'alamat_supplier',
        'telepon_supplier',
    ];

    public function Pembelian() {
        return $this->hasMany(Pembelian::class, 'id_supplier');
    }

    // public function ReturPembelian() {
    //     return $this->hasMany(ReturPembelian::class, 'id_supplier');
    // }
}
