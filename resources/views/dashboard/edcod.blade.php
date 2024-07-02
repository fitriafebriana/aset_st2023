@extends('template')
 
@section('content')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Monitoring Alur Editing Coding (Edcod) Pengolahan ST2023</h1>
                    </div>
                </div> 
                <!-- Small boxes (Stat box) -->
                <div class="row">
                  <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box bg-info">
                      <div class="inner">
                        <h3>{{$total_sls}}</h3>

                        <p>{{$total_sls}} NBS Sebagai Target Edcod</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-bag"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info</a>
                    </div>
                  </div>
                  <!-- ./col -->
                  <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3>{{$total_edcod}}</h3>

                        <p>{{$total_edcod/$total_sls*100}}% NBS Telah di Edcod</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info</a>
                    </div>
                  </div>
                  <div class="col-lg-4 col-4">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                      <div class="inner">
                        <h3>{{$total_sisa}}</h3>

                        <p>{{$total_sisa/$total_sls*100}}% NBS Belum di Edcod</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <!-- ./col -->
                </div>


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
                                    <th>Tgl Mulai Edcod</th>
                                    <th>Petugas Edcod</th>
                                    <th>Status Edcod</th>
                                    <th>Jumlah L1</th>
                                    <th>Jumlah L2</th>
                                    <th>Jumlah Peta WS</th>
                            </tr>    
                            </thead>
                            <tbody>
                                @foreach ($aluredcod as $al)
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
                                    {{-- <td>RT {{ $al->kode_nbs}}</td> --}}
                                    <td>{{ $al->kode_nbs}}</td>

                                    {{-- <td>{{ $al->nama_koseka}}</td> --}}
                                    <td>{{ $al->nama_pml}}</td>
                                    <td>{{ $al->nama_ppl}}</td>
                                    <td>{{ $al->tgl_mulai_edcod}}</td>
                                    <td>{{ $al->nama_petugas_edcod}}</td>
                                    <td>
                                        @if ($al->tgl_selesai_edcod == '0000-00-00') 
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