<table>
 <tr>
 <th>Nama Depan</th>
 <th>Nama Belakang</th>
 <th>Jenis Kelamin</th>
 <th>Agama</th>
 <th>Alamat</th>
 </tr>
 @foreach($data_siswa as $siswa)
 <tr>
 <th>{{$siswa->nama_depan}}</th>
 <th>{{$siswa->nama_belakang}}</th>
 <th>{{$siswa->jenis_kelamin}}</th>
 <th>{{$siswa->agama}}</th>
 <th>{{$siswa->alamat}}</th>
 </tr>
 @endforeach
</table>
