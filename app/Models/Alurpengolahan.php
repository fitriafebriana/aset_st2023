<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alurpengolahan extends Model
{
    use HasFactory;
    public $table = "transaksi";
    protected $fillable = [
        'id',
        'kode_prov',
        'kode_kota',
        'kode_kec',
        'kode_kel',
        'kode_nbs',
        'ppl',
        'pml',
        // 'koseka',
        'jenis_L1_UTP',
        'jenis_L2_UTP',
        'jenis_petawa',
        'jml_terima_L1_UTP',
        'jml_terima_L2_UTP',
        'jml_terima_petawa',
        'jml_pakai_L1_UTP',
        'jml_pakai_L2_UTP',
        'jml_pakai_xk',
        'jml_tpakai_L1_UTP',
        'jml_tpakai_L2_UTP',
        'jml_tpakai_petawa',
        'petugas_batching',
        'tgl_terima',
        'id_box_batching',
        'tgl_selesai_box',
        'petugas_entri',
        'tgl_mulai_entri',
        'tgl_selesai_entri',
        'petugas_edcod',
        'tgl_mulai_edcod',
        'tgl_selesai_edcod',
        'konsentrasi',
        'jumlah_ruta',
        'created_at',
        'updated_at'
    ];
}
