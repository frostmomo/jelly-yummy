<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Return_;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'nama_customer',
        'alamat_customer',
        'telepon_customer',
    ];

    public function Penjualan() {
        return $this->hasMany(Penjualan::class, 'id_customer');
    }

    public function Penerimaan() {
        return $this->hasMany(Penerimaan::class, 'id_customer');
    }

    // public function ReturPenjualan() {
    //     return $this->hasMany(ReturPenjualan::class, 'id_customer');
    // }
}
