<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alurentri extends Model
{
    use HasFactory;
    public $table = "transaksi";
    protected $fillable = [
        'id',
        'petugas_entri',
        'tgl_mulai_entri',
        'tgl_selesai_entri',
        'created_at',
        'updated_at'
    ];
}
