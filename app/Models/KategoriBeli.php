<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBeli extends Model
{
    use HasFactory;

    protected $table = 'kategori_beli';

    protected $fillable = [
        'kategori_beli',
    ];

    public function ProdukBeli() {
        return $this->hasMany(ProdukBeli::class, 'id_kategori_beli');
    }
}
