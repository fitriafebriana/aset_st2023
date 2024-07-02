<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluredcod extends Model
{
    use HasFactory;
    public $table = "transaksi";
    protected $fillable = [
        'id',
        'petugas_edcod',
        'tgl_mulai_edcod',
        'tgl_selesai_edcod',
        'konsentrasi',
        'jumlah_ruta',
        'created_at',
        'updated_at'
    ];
}
