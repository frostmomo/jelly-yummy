<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriJual extends Model
{
    use HasFactory;

    protected $table = 'kategori_jual';

    protected $fillable = [
        'kategori_jual',
    ];

    public function ProdukJual() {
        return $this->hasMany(ProdukJual::class, 'id_kategori_jual');
    }
}
