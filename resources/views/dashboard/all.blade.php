@extends('template')
 
@section('content')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Monitoring Alur Pengolahan ST2023</h1>
                    </div>
                </div> 
                <!-- Small boxes (Stat box) -->
                <div class="row">
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3>{{$total_sls}}</h3>

                        <p>{{$total_sls}} NBS Sebagai Target Pengolahan</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info</a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3>{{$total_penerimaan}}</h3>

                        {{-- <p>{{ round($total_penerimaan/$total_sls*100,2) }}% NBS Telah di Lakukan Batching Penerimaan</p> --}}
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="{{ url('/dashboard/')}}" class="small-box-footer">More info</a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                      <div class="inner">
                        <h3>{{$total_edcod}}</h3>

                        {{-- <p>{{ round($total_edcod/$total_sls*100,2) }}% NBS Sudah di Edcod</p> --}}
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="{{ url('/dashboard/edcod')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <h3>{{$total_entri}}</h3>

                        {{-- <p>{{ round($total_entri/$total_sls*100,2) }}% NBS Sudah/Sedang di Entri</p> --}}
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="{{ url('/dashboard/entri')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- End of Small boxes (Stat box) -->

                <!-- Info boxes -->
                <div class="row">
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                      <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Total Dokumen L2</span>
                        <span class="info-box-number">
                          {{ $total_L2 }}
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Total Dokumen L2 Diterima</span>
                        <span class="info-box-number">{{ $total_L2_terima }}</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->

                  <!-- fix for small devices only -->
                  <div class="clearfix hidden-md-up"></div>

                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Total Dokumen L2 Sudah Di Edcod</span>
                        <span class="info-box-number">{{ $total_L2_edcod }}</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                      <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Total Dokumen L2 Sudah/Sedang di Entri</span>
                        <span class="info-box-number">{{ $total_L2_entri }}</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->



                <div class="card">
                    <div class="card-body">
                        <table id="example3" class="display responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <!-- <th>Prov</th>
                                    <th>Kota</th> -->
                                    <th>Kecamatan</th>                                    
                                    <th>Kelurahan</th>                                    
                                    <th>NBS</th>                                    
                                    {{-- <th>Koseka</th>                                     --}}
                                    <th>PML</th>                                    
                                    <th>PPL</th>                                   
                                    <th>Tgl Mulai Penerimaan</th>
                                    <th>Petugas Batching</th>
                                    <th>Status Batching</th>                                  
                                    <th>Tgl Mulai Edcod</th>
                                    <th>Petugas Edcod</th>
                                    <th>Status Edcod</th>                                  
                                    <th>Tgl Mulai Entri</th>
                                    <th>Petugas Entri</th>
                                    <th>Status Entri</th>
                                    <th>Jumlah L1</th>
                                    <th>Jumlah L2</th>
                                    <th>Jumlah Peta WS</th>
                            </tr>    
                            </thead>
                            <tbody>
                                @foreach ($all as $al)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <!-- <td>@if ($al->kode_prov = 13) Sumatera Barat (13) @endif</td>
                                    <td>@if ($al->kode_kota = 74) Padang Panjang (74) @endif</td> -->
                                    <td>
                                        @if ($al->kode_kec == '010') 
                                            Padang Panjang Barat
                                        @elseif ($al->kode_kec == '020') 
                                            Padang Panjang Timur
                                        @endif
                                    </td>
                                    <td>{{ $al->nmkelurahan}} ( {{ $al->kode_kel}})</td>
                                    <td>{{ $al->kode_nbs}}</td>

                                    {{-- <td>RT {{ $al->kode_nbs}}</td> --}}
                                    {{-- <td>{{ $al->nama_koseka}}</td> --}}
                                    <td>{{ $al->nama_pml}}</td>
                                    <td>{{ $al->nama_ppl}}</td>
                                    <td>
                                        @if ($al->tgl_terima == '0000-00-00') 
                                            - 
                                        @else
                                            {{$al->tgl_terima}}
                                        @endif
                                    </td>
                                    <td>{{ $al->nama_petugas_batching}}</td>
                                    <td>
                                        @if ($al->tgl_terima == '0000-00-00') 
                                            Belum 
                                        @else
                                            Sudah
                                        @endif
                                    </td>
                                    <td>
                                        @if ($al->tgl_mulai_edcod == '0000-00-00') 
                                            - 
                                        @else
                                            {{$al->tgl_mulai_edcod}}
                                        @endif
                                    </td>
                                    <td>{{ $al->nama_petugas_edcod}}</td>
                                    <td>
                                        @if ($al->tgl_selesai_edcod == '0000-00-00') 
                                            Belum 
                                        @else
                                            Sudah
                                        @endif
                                    </td>
                                    <td>
                                        @if ($al->tgl_mulai_entri == '0000-00-00') 
                                            - 
                                        @else
                                            {{$al->tgl_mulai_entri}}
                                        @endif
                                    </td>
                                    <td>{{ $al->nama_petugas_entri}}</td>
                                    <td>
                                        @if ($al->tgl_selesai_entri == '0000-00-00') 
                                            Belum 
                                        @else
                                            Sudah
                                        @endif
                                    </td>
                                    <td>{{ $al->jml_terima_L1_UTP}}</td>                                    
                                    <td>{{ $al->jml_terima_L2_UTP}}</td>                                    
                                    <td>{{ $al->jml_terima_petaws}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>  
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('#example3').DataTable({
      "scrollX": true,
       responsive: true,
       dom: 'Bfrtip',
        columnDefs: [
            {
                targets: 1,
                className: 'noVis'
            }
        ],
        buttons: [
            {
                extend: 'colvis',
                columns: ':not(.noVis)'
            }
        ]
    });
  } );
</script>
@endpush