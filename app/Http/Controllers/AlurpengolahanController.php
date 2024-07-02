<?php

namespace App\Http\Controllers;

use App\Models\Alurdokumen;
use App\Models\Alurpengolahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AlurpengolahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $alurdokumen = DB::table('transaksi')    
             ->where('transaksi.petugas_batching', '=', NULL)
             ->join('master_kel', function ($join) {
                $join->on('master_kel.idkec', '=', 'transaksi.kode_kec')
                     ->on('master_kel.idkelurahan', '=', 'transaksi.kode_kel');
               })
             ->join('users AS A', 'A.id', 'transaksi.ppl')
             ->join('users AS B', 'B.id', 'transaksi.pml')
            //  ->join('users AS C', 'C.id', 'transaksi.koseka')
             ->select('transaksi.*', 'master_kel.nmkelurahan', 'A.name as nama_ppl', 'B.name as nama_pml')
             ->get();
             // dd($alurdokumen);
        return view('alurolah.index_lp', compact('alurdokumen'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function selfrekap()
    {
        $alurdokumen = DB::table('transaksi')    
             ->where('transaksi.petugas_batching', '=', Auth::user()->id )    
             ->join('master_kel', function ($join) {
                $join->on('master_kel.idkec', '=', 'transaksi.kode_kec')
                     ->on('master_kel.idkelurahan', '=', 'transaksi.kode_kel');
               })
             ->join('users AS A', 'A.id', 'transaksi.ppl')
             ->join('users AS B', 'B.id', 'transaksi.pml')
            //  ->join('users AS C', 'C.id', 'transaksi.koseka')
             ->select('transaksi.*', 'master_kel.nmkelurahan', 'A.name as nama_ppl', 'B.name as nama_pml')
             ->get();
        return view('alurolah.index_sp', compact('alurdokumen'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alurdokumen  $alurdokumen
     * @return \Illuminate\Http\Response
     */
    public function show(Alurdokumen $alurdokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alurdokumen  $alurdokumen
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alurdokumen = DB::table('transaksi')
            ->where('transaksi.id', $id)
            ->join('master_kel', function ($join) {
                $join->on('master_kel.idkec', '=', 'transaksi.kode_kec')
                     ->on('master_kel.idkelurahan', '=', 'transaksi.kode_kel');
               })
             ->join('m_petugas AS A', 'A.id', 'transaksi.ppl')
             ->join('m_petugas AS B', 'B.id', 'transaksi.pml')
            //  ->join('m_petugas AS C', 'C.id', 'transaksi.koseka')
             ->select('transaksi.*', 'master_kel.nmkelurahan', 'A.nama as nama_ppl', 'B.nama as nama_pml')
            ->first();
        // dd($alurdokumen);
        return view('alurolah.edit', compact('alurdokumen'));
    }

    public function editselfrekap($id)
    {
        $alurdokumen = DB::table('transaksi')
            ->where('transaksi.id', $id)
            ->join('master_kel', function ($join) {
                $join->on('master_kel.idkec', '=', 'transaksi.kode_kec')
                     ->on('master_kel.idkelurahan', '=', 'transaksi.kode_kel');
               })
             ->join('m_petugas AS A', 'A.id', 'transaksi.ppl')
             ->join('m_petugas AS B', 'B.id', 'transaksi.pml')
            //  ->join('m_petugas AS C', 'C.id', 'transaksi.koseka')
             ->select('transaksi.*', 'master_kel.nmkelurahan', 'A.nama as nama_ppl', 'B.nama as nama_pml')
            ->first();
        // dd($alurdokumen);
        return view('alurolah.editselfrekap', compact('alurdokumen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alurdokumen  $alurdokumen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $alurdokumen = Alurpengolahan::find($id);
        if($alurdokumen) {
            $alurdokumen->jml_terima_L1_UTP = $request->jml_terima_L1_UTP;
            $alurdokumen->jml_terima_L2_UTP = $request->jml_terima_L2_UTP;
            $alurdokumen->jml_terima_petaws = $request->jml_terima_petaws;
            $alurdokumen->jml_pakai_L1_UTP = $request->jml_pakai_L1_UTP;
            $alurdokumen->jml_pakai_L2_UTP = $request->jml_pakai_L2_UTP;
            $alurdokumen->jml_pakai_petaws = $request->jml_pakai_petaws;
            $alurdokumen->jml_tpakai_L1_UTP = $request->jml_tpakai_L1_UTP;
            $alurdokumen->jml_tpakai_L2_UTP = $request->jml_tpakai_L2_UTP;
            $alurdokumen->jml_tpakai_petaws = $request->jml_tpakai_petaws;            
            $alurdokumen->jumlah_ruta = $request->jumlah_ruta;
            $alurdokumen->petugas_batching = Auth::user()->id;           
            $alurdokumen->updated_at = now()->timestamp;
            $alurdokumen->save();
        }
        return redirect()->route('alurpengolahan.index')->with('success', 'Dokumen sudah teralokasi di Petugas Batching');
    }

    public function updateselfrekap(Request $request, $id)
    {
        $alurdokumen = Alurpengolahan::find($id);
        if($alurdokumen) {
            $alurdokumen->jml_terima_L1_UTP = $request->jml_terima_L1_UTP;
            $alurdokumen->jml_terima_L2_UTP = $request->jml_terima_L2_UTP;
            $alurdokumen->jml_terima_petaws = $request->jml_terima_petaws;
            $alurdokumen->jml_pakai_L1_UTP = $request->jml_pakai_L1_UTP;
            $alurdokumen->jml_pakai_L2_UTP = $request->jml_pakai_L2_UTP;
            $alurdokumen->jml_pakai_petaws = $request->jml_pakai_petaws;
            $alurdokumen->jml_tpakai_L1_UTP = $request->jml_tpakai_L1_UTP;
            $alurdokumen->jml_tpakai_L2_UTP = $request->jml_tpakai_L2_UTP;
            $alurdokumen->jml_tpakai_petaws = $request->jml_tpakai_petaws;
            $alurdokumen->tgl_terima = $request->tgl_terima;
            $alurdokumen->petugas_batching = 100;
            $alurdokumen->tgl_terima = date('Y-m-d');            
            $alurdokumen->updated_at = now()->timestamp;
            $alurdokumen->save();
        }
        // dd($alurdokumen->tgl_selesai_p);
        return redirect()->route('alurpengolahan.selfrekap')->with('success', 'Dokumen sudah selesai di diterima oleh Petugas batching');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alurdokumen  $alurdokumen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Hapus Data
        $alurdokumen = Alurdokumen::find($id); 
        $alurdokumen->delete();

        // setelah berhasil hapus
        return redirect('/alurpengolahan');
    }
}
