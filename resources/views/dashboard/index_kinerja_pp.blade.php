@extends('template')
 
@section('content')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">                
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Monitoring Kinerja Petugas Pengolahan ST2023</h1>
                    </div>
                </div>                 
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- success message -->
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <!-- warning message -->
                @if ($message = Session::get('warning'))
                <div class="alert alert-warning">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <!-- error message -->
                @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
                @endif


                <div class="content-header">
                    <div class="container-fluid">                
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Kinerja Petugas Pengolahan Receiving Batching ST2023</h1>
                            </div>
                        </div>                 
                    </div><!-- /.container-fluid -->
                </div>

                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="display responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Petugas</th>   
                                    <th>Total NBS yang di Telah/Sedang Batching</th>                                 
                                    <th>Total Dokumen L2 yang di Telah/Sedang Batching</th>
                            </tr>    
                            </thead>
                            <tbody>
                                @foreach ($rekap_p_terima as $al)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $al->name}}</td>                                    
                                    <td>{{ $al->total_sls}}</td>
                                    <td>{{ $al->total_dokumen}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 


                <div class="content-header">
                    <div class="container-fluid">                
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Kinerja Petugas Pengolahan Editing Coding ST2023</h1>
                            </div>
                        </div>                 
                    </div><!-- /.container-fluid -->
                </div>

                <div class="card">
                    <div class="card-body">
                        <table id="example2" class="display responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Petugas</th>   
                                    <th>Total NBS yang di Telah/Sedang Edcod</th>                                 
                                    <th>Total Dokumen L2 yang di Telah/Sedang Edcod</th>
                            </tr>    
                            </thead>
                            <tbody>
                                @foreach ($rekap_p_edcod as $al)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $al->name}}</td>                                    
                                    <td>{{ $al->total_sls}}</td>
                                    <td>{{ $al->total_dokumen}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 



                <div class="content-header">
                    <div class="container-fluid">                
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0">Kinerja Petugas Pengolahan Entri ST2023</h1>
                            </div>
                        </div>                 
                    </div><!-- /.container-fluid -->
                </div>
                <div class="card">
                    <div class="card-body">
                        <table id="example3" class="display responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Petugas</th>   
                                    <th>Total NBS yang di Telah/Sedang Entri</th>                                 
                                    <th>Total Dokumen L2 yang di Telah/Sedang Entri</th>
                            </tr>    
                            </thead>
                            <tbody>
                                @foreach ($agregate_sls as $al)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>{{ $al->name}}</td>                                    
                                    <td>{{ $al->total_sls}}</td>
                                    <td>{{ $al->total_dokumen}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    $('#example1').DataTable({
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
<script type="text/javascript">
  $(document).ready(function() {
    $('#example2').DataTable({
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