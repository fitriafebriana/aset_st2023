@extends('template')
 
@section('content')
<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Entri Penerimaan Edcod</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="card-title">Detail Data Posisi Dokumen Edcod :</h4>                         
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ route('aluredcod.update',$alurdokumen->id) }}" id="form-alokasi-doc-pengolahan" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
<!-- sjdkasj -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <strong>Kabupaten/Kota :</strong>
                                        <input type="text" name="id_survei" value="Padang Panjang (74)" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <strong>Kecamatan :</strong>
                                        <input type="text" name="nama_responden" value="@if ($alurdokumen->kode_kec == '010') Padang Panjang Barat (010) @elseif ($alurdokumen->kode_kec == '020')Padang Panjang Timur (020) @endif" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <strong>Desa/Kelurahan :</strong>
                                        <input type="text" name="nama_responden" value="{{ $alurdokumen->nmkelurahan }} ({{ $alurdokumen->kode_kel }})" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <strong>NBS (RT) :</strong>
                                        <input type="text" name="nama_responden" value="RT {{ $alurdokumen->kode_nbs }}" class="form-control" disabled>
                                    </div>
                                    <br> 
                                    <div class="form-group">
                                        <strong>Tanggal Mulai Edcod :</strong>
                                        <input type="date" name="tgl_mulai_edcod" class="form-control">
                                    </div>                                    
                                    <br>
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                                    <script type="text/javascript">
                                        $( '#form-alokasi-doc-pengolahan' ).on('submit', function(e) {
                                           if($( 'input[class^="cbp"]:checked' ).length === 0) {
                                              alert( 'Oops! Anda Belum Menceklist CheckBox, Silahkan Pilih Checkbox Terdahulu atau keluar dari laman ini.' );
                                              e.preventDefault();
                                           }
                                        });
                                    </script>
                                    <div class="form-group">
                                        <input type="checkbox" id="checkbox" class="cbp" name="checkbox" value="1">
                                        <label for="checkbox">Dengan ini saya (selaku petugas edcod) menyatakan bahwa dokumen dengan kode NBS di atas sudah saya terima di bagian penerimaan editing coding.</label><br>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection