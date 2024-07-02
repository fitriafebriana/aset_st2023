<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
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

    public function all()
    {
        $all = DB::table('transaksi') 
             ->join('master_kel', function ($join) {
                $join->on('master_kel.idkec', '=', 'transaksi.kode_kec')
                     ->on('master_kel.idkelurahan', '=', 'transaksi.kode_kel');
               })
             ->join('users AS A', 'A.id', 'transaksi.ppl')
             ->join('users AS B', 'B.id', 'transaksi.pml')
            //  ->join('users AS C', 'C.id', 'transaksi.koseka')
             ->leftJoin('users AS D', 'D.id', 'transaksi.petugas_batching')
             ->leftJoin('users AS E', 'E.id', 'transaksi.petugas_edcod')
             ->leftJoin('users AS F', 'F.id', 'transaksi.petugas_entri')
             ->select('transaksi.*', 'master_kel.nmkelurahan', 'A.name as nama_ppl', 'B.name as nama_pml','D.name as nama_petugas_batching', 'E.name as nama_petugas_edcod', 'F.name as nama_petugas_entri' )
             ->get();   

        $total_sls = DB::table('transaksi')->count();
        $total_penerimaan = DB::table('transaksi')->whereNotNull('transaksi.petugas_batching')->count();
        $total_edcod = DB::table('transaksi')->whereNotNull('transaksi.petugas_edcod')->count();
        $total_entri = DB::table('transaksi')->whereNotNull('transaksi.petugas_entri')->count();

        $total_L2 = DB::table('transaksi')->sum('jml_pakai_L2_UTP');
        $total_L2_terima = DB::table('transaksi')->whereNotNull('transaksi.petugas_batching')->sum('jml_pakai_L2_UTP');
        $total_L2_edcod = DB::table('transaksi')->whereNotNull('transaksi.petugas_edcod')->sum('jml_pakai_L2_UTP');
        $total_L2_entri = DB::table('transaksi')->whereNotNull('transaksi.petugas_entri')->sum('jml_pakai_L2_UTP');


        return view('dashboard.all', compact('all', 'total_sls', 'total_penerimaan', 'total_edcod', 'total_entri', 'total_L2', 'total_L2_terima', 'total_L2_edcod', 'total_L2_entri'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function index()
    {
        $alurdokumen = DB::table('transaksi') 
             ->join('master_kel', function ($join) {
                $join->on('master_kel.idkec', '=', 'transaksi.kode_kec')
                     ->on('master_kel.idkelurahan', '=', 'transaksi.kode_kel');
               })
             ->join('users AS A', 'A.id', 'transaksi.ppl')
             ->join('users AS B', 'B.id', 'transaksi.pml')
            //  ->join('users AS C', 'C.id', 'transaksi.koseka')
             ->leftJoin('users AS D', 'D.id', 'transaksi.petugas_batching')
             ->select('transaksi.*', 'master_kel.nmkelurahan', 'A.name as nama_ppl', 'B.name as nama_pml','D.name as nama_petugas_batching' )
             ->get();   
        $total_penerimaan = DB::table('transaksi')->whereNotNull('transaksi.petugas_batching')->count();
        $total_sls = DB::table('transaksi')->count();
        $total_sisa = $total_sls - $total_penerimaan;  
        // dd($total_sls);
        return view('dashboard.index_ar', compact('alurdokumen','total_penerimaan', 'total_sls', 'total_sisa'))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function kinerjapp()
    {
        $agregate_sls = DB::table('transaksi')
            ->whereNotNull('transaksi.petugas_entri')
            ->join('users', 'users.id', '=', 'transaksi.petugas_entri')
            ->select('transaksi.petugas_entri', 'users.name',
                      DB::raw("(sum(jml_terima_L2_UTP)) as total_dokumen"),
                      DB::raw("(count(tgl_mulai_entri)) as total_sls")
                  )
            ->groupBy('users.name','transaksi.petugas_entri')
            ->get();

        $rekap_p_edcod = DB::table('transaksi')
            ->whereNotNull('transaksi.petugas_edcod')
            ->join('users', 'users.id', '=', 'transaksi.petugas_edcod')
            ->select('transaksi.petugas_edcod', 'users.name',
                      DB::raw("(sum(jml_terima_L2_UTP)) as total_dokumen"),
                      DB::raw("(count(tgl_mulai_entri)) as total_sls")
                  )
            ->groupBy('users.name','transaksi.petugas_edcod')
            ->get();

        $rekap_p_terima = DB::table('transaksi')
            ->whereNotNull('transaksi.petugas_batching')
            ->join('users', 'users.id', '=', 'transaksi.petugas_batching')
            ->select('transaksi.petugas_batching', 'users.name',
                      DB::raw("(sum(jml_terima_L2_UTP)) as total_dokumen"),
                      DB::raw("(count(tgl_mulai_entri)) as total_sls")
                  )
            ->groupBy('users.name','transaksi.petugas_batching')
            ->get();

        return view('dashboard.index_kinerja_pp', compact('agregate_sls', 'rekap_p_edcod', 'rekap_p_terima'))->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Display a listing of the document 
     *
     * @return \Illuminate\Http\Response
     */
    public function edcod()
    {
        $aluredcod = DB::table('transaksi')
             ->join('master_kel', function ($join) {
                $join->on('master_kel.idkec', '=', 'transaksi.kode_kec')
                     ->on('master_kel.idkelurahan', '=', 'transaksi.kode_kel');
               })
             ->join('users AS A', 'A.id', 'transaksi.ppl')
             ->join('users AS B', 'B.id', 'transaksi.pml')
            //  ->join('users AS C', 'C.id', 'transaksi.koseka')
             ->leftJoin('users AS D', 'D.id', 'transaksi.petugas_edcod')
             ->select('transaksi.*', 'master_kel.nmkelurahan', 'A.name as nama_ppl', 'B.name as nama_pml', 'D.name as nama_petugas_edcod' )
             ->get();
        $total_edcod = DB::table('transaksi')->whereNotNull('transaksi.petugas_edcod')->count();
        $total_sls = DB::table('transaksi')->count();
        $total_sisa = $total_sls - $total_edcod;  
        // dd($total_sls);
        return view('dashboard.edcod', compact('aluredcod','total_edcod', 'total_sls', 'total_sisa'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Display a listing of the document 
     *
     * @return \Illuminate\Http\Response
     */
    public function entri()
    {
        $alurentri = DB::table('transaksi')
             ->join('master_kel', function ($join) {
                $join->on('master_kel.idkec', '=', 'transaksi.kode_kec')
                     ->on('master_kel.idkelurahan', '=', 'transaksi.kode_kel');
               })
             ->join('users AS A', 'A.id', 'transaksi.ppl')
             ->join('users AS B', 'B.id', 'transaksi.pml')
            //  ->join('users AS C', 'C.id', 'transaksi.koseka')
             ->leftJoin('users AS D', 'D.id', 'transaksi.petugas_entri')
             ->select('transaksi.*', 'master_kel.nmkelurahan', 'A.name as nama_ppl', 'B.name as nama_pml',  'D.name as nama_petugas_entri' )
             ->get();
        $total_entri = DB::table('transaksi')->whereNotNull('transaksi.petugas_entri')->count();
        $total_sls = DB::table('transaksi')->count();
        $total_sedang_entri = DB::table('transaksi')->whereNotNull('transaksi.petugas_entri')->where('transaksi.tgl_selesai_entri', '0000-00-00')->count();
        $total_sisa = $total_sls - $total_entri;  
        // dd($total_sedang_entri);
        return view('dashboard.entri', compact('alurentri','total_entri', 'total_sls', 'total_sisa', 'total_sedang_entri'))->with('i', (request()->input('page', 1) - 1) * 5);
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
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard  $dashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
