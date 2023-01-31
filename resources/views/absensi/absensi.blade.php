@extends('layouts.master')
<script language='JavaScript'>
    var txt="AbsenSiswa | Absensi ";
    var speed=300;
    var refresh=null;
    function action() { document.title=txt;
    txt=txt.substring(1,txt.length)+txt.charAt(0);
    refresh=setTimeout("action()",speed);}action();
    </script>
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Admin</li>
            <li class="active">Absensi</li>
        </ol>
    </div><!--/.row-->
    @if(session()->exists('notif'))
    @if(session()->get('notif')['success'])
    {!! 
    '<div class="alert alert-success alert-dismissable"> 
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Sukses! </strong>'. session()->get('notif')['msgaction'] .'
    </div>' 
    !!}
    @else
    {!! 
    '<div class="alert alert-danger alert-dismissable"> 
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    <strong>Gagal! </strong>'. session()->get('notif')['msgaction'] .'
    </div>' 
    !!}
    @endif
    @endif
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Absensi Siswa {{$resource->tingkat_kelas. "-".$resource->jurusan. " " .$resource->nama_kelas." (".(Carbon\Carbon::now('Asia/Jakarta')->format('d F Y')).")"}}</div>
                <form action="/absensi" method="post">
                    <input type="hidden" name="kelas" value="{{$resource->id_kelas}}">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="absensi" class="table table-bordred table-striped">
                                    <thead>
                                        <tr>
                                            <th width="2%"><input type="checkbox" id="checkall" /> </th>
                                            <th width="3%" class="text-center">No</th>
                                            <th width="20%">NIS</th>
                                            <th width="20%">Nama Siswa</th>
                                            <th width="15%" colspan="3" class="text-center">Keterangan</th>
                                            <th width="15%" colspan="4" class="text-center">Detail</th>

                                        </tr>
                                    </thead>
                                    <tbody id="isi">
                                        @foreach ($resource->siswa as $index => $res)
                                        
                                        <tr>
                                            <input type="hidden" name="siswa[]" value="{{$res->id_siswa}}">
                                            <td><input type="checkbox" class="checkthis" /></td>
                                            <td class="text-center">{{ $index+1 }}</td>
                                            <td>{{ $res->nis}}</td>
                                            <td>{{ $res->nama}}</td>
                                            <td>{{ $res->status}}</td>
                                            <td>{{ $res->keterangan}}</td>
                                            <td>
                                                @if($resource->absen->count()!=0)
                                                @foreach($resource->absen as $absen)
                                                    @if($absen->nis==$res->nis && $absen->pivot->tanggal==Carbon\Carbon::now('Asia/Jakarta')->format('Y-m-d'))
                                                        <p>{{$absen->pivot->status}}</p>
                                                        <td>{{ $absen->pivot->keterangan}}</td>
                                                        @break
                                                    @else
                                                        @if($loop->last)
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Hadir" checked>Hadir
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Alfa" >Alfa
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Izin" >Izin
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Sakit" >Sakit
                                                            </label>
                                                            <div class="mb-5">
                                                                <label for="input" class="form-label">Keterangan</label>
                                                                <input type="input" class="form-control" name="keterangan" aria-describedby="keterangan">
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @else
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Hadir" checked>Hadir
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Alfa" >Alfa
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Izin" >Izin
                                                            </label>
                                                            <label class="radio-inline">
                                                                <input id="aktif" type="radio" name="status[{{$index}}]" value="Sakit" >Sakit
                                                            </label>
                                                                <div class="mb-5">
                                                                  <label for="input" class="form-label">Keterangan</label>
                                                                  <input type="text"  class="form-control" name="keterangan" aria-describedby="keterangan">                                                                    </div>
                                                @endif
                                                
                                                
                                            </td>


                                            

                                        </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <p data-placement="top" data-toggle="tooltip" title="Add" class="pull-right"><button class="btn btn-primary btn-sm" type="submit" data-title="Add">Submit</button></p>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-12">
                <p class="back-link">&copy; <?php echo date('Y') ?> AbsenSiswa</p>
            </div>
        </div><!--/.row-->
    </div>
</div>
@endsection
