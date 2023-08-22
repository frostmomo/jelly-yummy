<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;
    
    protected $table = 'penerimaan';

    protected $fillable = [
        'id_user',
        'id_customer',
        'uraian',
        'subtotal',
    ];

    public function User()
    {
        $this->belongsTo(User::class, 'id_user');
    }

    public function Customer()
    {
        $this->belongsTo(Customer::class, 'id_customer');
    }

    public function PenerimaanDetail()
    {
        $this->hasMany(PenerimaanDetail::class, 'id_penerimaan');
    }
}