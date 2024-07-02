@extends('template')
 
@section('content')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tabel Dokumen Belum Diterima di Pengolahan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Tabel</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row mb-2">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <a href="{{ url('/alokasipetugas/create') }}" class="btn btn-primary float-sm-right">Input </a>
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

                <div class="card">
                    <div class="card-body">
                        <table id="example" class="display responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <!-- <th>Prov</th>
                                    <th>Kota</th> -->
                                    <th>Kecamatan</th>                                    
                                    <th>Kelurahan</th>                                    
                                    <th>NBS</th>
                                    <th class="text-center">Aksi</th>
                            </tr>    
                            </thead>
                            <tbody>
                                @foreach ($alurdokumen as $al)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td>
                                        @if ($al->kode_kec == '010') 
                                            Padang Panjang Barat
                                        @elseif ($al->kode_kec == '020') 
                                            Padang Panjang Timur
                                        @endif
                                    </td>
                                    <td>{{ $al->nmkelurahan}} ( {{ $al->kode_kel}})</td>
                                    <td>RT {{ $al->kode_nbs}}</td>
                                    <td class="text-center"> 
                                        <a class="btn btn-info btn-sm" href="{{ route('alurpengolahan.edit',$al->id) }}">Entri</a>
                                    </td>
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
    $('#example').DataTable({
      "scrollX": true,
       responsive: true
    });
  } );
</script>
@endpush