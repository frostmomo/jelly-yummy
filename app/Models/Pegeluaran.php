<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $fillable = [
        'id_user',
        'id_supplier',
        'uraian',
        'subtotal',
    ];

    public function User()
    {
        $this->belongsTo(User::class, 'id_user');
    }

    public function Supplier()
    {
        $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function PengeluaranDetail()
    {
        $this->hasMany(PengeluaranDetail::class, 'id_pengeluaran');
    }
}
