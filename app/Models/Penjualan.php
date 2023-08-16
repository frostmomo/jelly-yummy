<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'id_user',
        'id_customer',
        'id_salesman',
        'total_item',
        'subtotal',
        'diskon',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }

    public function Salesman()
    {
        return $this->belongsTo(Salesman::class, 'id_salesman', 'id');
    }

    public function PenjualanDetail()
    {
        return $this->hasMany(PenjualanDetail::class, 'id_penjualan', 'id');
    }

    public function Piutang()
    {
        return $this->hasMany(Piutang::class, 'id_penjualan');
    }
}
