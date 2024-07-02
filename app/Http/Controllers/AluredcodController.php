<?php

namespace App\Http\Controllers;

use App\Models\Aluredcod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class AluredcodController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the document that hasn't yet edcode.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aluredcod = DB::table('transaksi')    
             ->where('transaksi.petugas_edcod', '=', NULL)
             ->join('master_kel', function ($join) {
                $join->on('master_kel.idkec', '=', 'transaksi.kode_kec')
                     ->on('master_kel.idkelurahan', '=', 'transaksi.kode_kel');
               })
             ->join('users AS A', 'A.id', 'transaksi.ppl')
             ->join('users AS B', 'B.id', 'transaksi.pml')
            //  ->join('users AS C', 'C.id', 'transaksi.koseka')
             ->select('transaksi.*', 'master_kel.nmkelurahan', 'A.name as nama_ppl', 'B.name as nama_pml')
             ->get();
             // dd($aluredcod);
        return view('aluredcod.index', compact('aluredcod'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the document that has yet edcode.
     *
     * @return \Illuminate\Http\Response
     */
    public function selfrekap()
    {
        $aluredcod = DB::table('transaksi')    
             ->where('transaksi.petugas_edcod', '=', Auth::user()->id )    
             ->join('master_kel', function ($join) {
                $join->on('master_kel.idkec', '=', 'transaksi.kode_kec')
                     ->on('master_kel.idkelurahan', '=', 'transaksi.kode_kel');
               })
             ->join('users AS A', 'A.id', 'transaksi.ppl')
             ->join('users AS B', 'B.id', 'transaksi.pml')
            //  ->join('users AS C', 'C.id', 'transaksi.koseka')
             ->select('transaksi.*', 'master_kel.nmkelurahan', 'A.name as nama_ppl', 'B.name as nama_pml')
             ->get();
        // dd($aluredcod);
        return view('aluredcod.index_sp', compact('aluredcod'))->with('i', (request()->input('page', 1) - 1) * 5);
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
     * @param  \App\Models\Aluredcod  $aluredcod
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $alurdokumen = DB::table('transaksi')    
             ->where('transaksi.petugas_edcod', '=', Auth::user()->id )    
             ->join('master_kel', function ($join) {
                $join->on('master_kel.idkec', '=', 'transaksi.kode_kec')
                     ->on('master_kel.idkelurahan', '=', 'transaksi.kode_kel');
               })
             ->join('users AS A', 'A.id', 'transaksi.ppl')
             ->join('users AS B', 'B.id', 'transaksi.pml')
            //  ->join('users AS C', 'C.id', 'transaksi.koseka')
             ->select('transaksi.*', 'master_kel.nmkelurahan', 'A.name as nama_ppl', 'B.name as nama_pml')
             ->get();
        return view('aluredcod.index_sp', compact('alurdokumen'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aluredcod  $aluredcod
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
        return view('aluredcod.edit', compact('alurdokumen'));
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
        return view('aluredcod.editselfrekap', compact('alurdokumen'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluredcod  $aluredcod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $alurdokumen = Aluredcod::find($id);
        if($alurdokumen) {
            $alurdokumen->tgl_mulai_edcod = $request->tgl_mulai_edcod;
            $alurdokumen->petugas_edcod = Auth::user()->id;            
            $alurdokumen->updated_at = now()->timestamp;
            $alurdokumen->save();
        }
        return redirect()->route('aluredcod.index')->with('success', 'Dokumen sudah teralokasi di Petugas Edcod');
    }

    public function updateselfrekap(Request $request, $id)
    {
        $alurdokumen = Aluredcod::find($id);
        if($alurdokumen) {
            $alurdokumen->jumlah_ruta = $request->jumlah_ruta;
            $alurdokumen->tgl_selesai_edcod = $request->tgl_selesai_edcod;          
            $alurdokumen->updated_at = now()->timestamp;
            $alurdokumen->save();
        }
        return redirect()->route('aluredcod.selfrekap')->with('success', 'Dokumen sudah selesai eiting coding oleh Petugas Edcod');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluredcod  $aluredcod
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluredcod $aluredcod)
    {
        //
    }
}
