<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salesman extends Model
{
    use HasFactory;

    protected $table = 'salesman';

    protected $fillable = [
        'nama_salesman',
        'alamat_salesman',
    ];

    public function Penjualan() {
        return $this->hasMany(Penjualan::class, 'id_salesman');
    }
}
