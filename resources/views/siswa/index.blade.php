<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Pemrograman Web 2</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
   <div class="container">
      <div class="row mt-4">
         <div class="col-6">
            <h1>Data Siswa</h1>
         </div>
         <div class="col-6">
            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
               data-bs-target="#modalCreate">
               Tambah Data Siswa
            </button>
         </div>
         <div class="col-12">
            @if(session('sukses'))
            <div class="alert alert-success" role="alert">
               {{session('sukses')}}
            </div>
            @endif
            <table class="table table-striped table-hover">
               <thead>
                  <tr>
                     <th>Nama Depan</th>
                     <th>Nama Belakang</th>
                     <th>Jenis Kelamin</th>
                     <th>Agama</th>
                     <th>Alamat</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($data_siswa as $siswa)
                  <tr>
                     <td>{{$siswa->nama_depan}}</td>
                     <td>{{$siswa->nama_belakang}}</td>
                     <td>{{$siswa->jenis_kelamin}}</td>
                     <td>{{$siswa->agama}}</td>
                     <td>{{$siswa->alamat}}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>

   <!-- Modal -->
   <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
      <form action="/siswa/store" method="POST">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h1 class="modal-title fs-5" id="modalCreateLabel">Modal title</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                  {{ csrf_field() }}
                  <div class="form-group mb-3">
                     <label for="nama_depan">Nama Depan</label>
                     <input type="text" class="form-control" name="nama_depan" id="nama_depan"
                        aria-describedby="nama_depan" placeholder="Nama Depan">
                  </div>
                  <div class="form-group mb-3">
                     <label for="nama_belakang">Nama Belakang</label>
                     <input type="text" class="form-control" name="nama_belakang" id="nama_belakang"
                        aria-describedby="nama_belakang" placeholder="Nama Belakang">
                  </div>
                  <div class="form-group mb-3">
                     <label for="jenis_kelamin">Pilih Jenis Kelamin</label>
                     <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                     </select>
                  </div>
                  <div class="form-group mb-3">
                     <label for="agama">Agama</label>
                     <input type="text" class="form-control" name="agama" id="agama" ariadescribedby="nama_depan"
                        placeholder="Agama">
                  </div>
                  <div class="form-group mb-3">
                     <label for="alamat">Alamat</label>
                     <textarea class="form-control" name="alamat" id="alamat" rows="3"></textarea>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
               </div>
            </div>
         </div>
      </form>
   </div>


   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
      integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
   </script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"
      integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous">
   </script>
</body>

</html>