@extends('layouts.master')
@section('content')
<div class="main">
   <div class="main-content">
      <div class="container-fluid">
         <div class="row">
            <div class="panel">
               <div class="panel-heading">
                  <h3 class="panel-title">Data Siswa</h3>
                  <div class="right">
                     <button type="button" class="btn" data-toggle="modal" datatarget="#tambahData">Tambah Data Siswa
                        <i class="lnr lnr-plus-circle"></i></button>
                  </div>
               </div>
               <div class="panel-body">
                  @if(session('sukses'))
                  <div class="alert alert-success" role="alert">
                     {{session('sukses')}}
                  </div>
                  @endif
                  <table id="table_siswa" class="display table table-hover">
                     <thead>
                        <tr>
                           <th>Nama Depan</th>
                           <th>Nama Belakang</th>
                           <th>Jenis Kelamin</th>
                           <th>Agama</th>
                           <th>Alamat</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($data_siswa as $siswa)
                        <tr>
                           <th><a href="/siswa/{{$siswa->id}}/profile">{{ $siswa->nama_depan }}</a></th>
                           <th>{{$siswa->nama_belakang}}</th>
                           <th>{{$siswa->jenis_kelamin}}</th>
                           <th>{{$siswa->agama}}</th>
                           <th>{{$siswa->alamat}}</th>
                           <th>
                              <a href="/siswa/{{$siswa->id}}/edit" class="btn btn-warning btnsm">Edit</a>
                              <a href="/siswa/{{$siswa->id}}/delete" class="btn btn-danger btnsm"
                                 onclick="return confirm('Apakah yakin ingin dihapus?')">Delete</a>
                           </th>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="tambahData" tabindex="-1" role="dialog" arialabelledby="tambahData"
               aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="tambahData">Tambah Data Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" arialabel="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form action="/siswa/create" method="POST">
                           {{ csrf_field() }}
                           <div class="form-group">
                              <label for="nama_depan">Nama Depan</label>
                              <input type="text" class="form-control" name="nama_depan" id="nama_depan"
                                 aria-describedby="nama_depan" placeholder="Nama Depan">
                           </div>
                           <div class="form-group">
                              <label for="nama_belakang">Nama Belakang</label>
                              <input type="text" class="form-control" name="nama_belakang" id="nama_belakang"
                                 aria-describedby="nama_belakang" placeholder="Nama Belakang">
                           </div>
                           <div class="form-group">
                              <label for="jenis_kelamin">Pilih Jenis Kelamin</label>
                              <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                 <option value="L">Laki-laki</option>
                                 <option value="P">Perempuan</option>
                              </select>
                           </div>
                           <div class="form-group">
                              <label for="agama">Agama</label>
                              <input type="text" class="form-control" name="agama" id="agama"
                                 aria-describedby="nama_depan" placeholder="Agama">
                           </div>
                           <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
                           </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" datadismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@stop