<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Exports\SiswaExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index()
    {
        $data_siswa = Siswa::all();
        return view('siswa.index', ['data_siswa' => $data_siswa]);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $check = Siswa::create($data);
        if (!$check) {
            $arr = array('msg' => 'Gagal simpan dengan Ajax', 'status' => false);
        } else {
            $arr = array('msg' => 'Sukses simpan dengan Ajax', 'status' => true);
        }
        return Response()->json($arr);
    }

    public function edit($id)
    {
        $siswa = Siswa::find($id);
        return view('siswa/edit', ['siswa' => $siswa]);
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        $siswa->update($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('uploads/foto/', $request->file('foto')->getClientOriginalName());
            $siswa->foto = $request->file('foto')->getClientOriginalName();
            $siswa->save();
        }
        return redirect('/siswa')->with('sukses', 'Data berhasil di-update.');
    }

    public function profile($id)
    {
        $siswa = Siswa::find($id);
        $matapelajaran = Mapel::all();
        return view('siswa.profile', ['siswa' => $siswa, 'matapelajaran' =>
        $matapelajaran]);
    }

    public function exportExcel()
    {
        $nama_file = 'laporan_data_siswa_' . date('Y-m-d_H-i-s') . '.xlsx';
        return Excel::download(new SiswaExport, $nama_file);
    }

    public function pdf()
    {
        $data_siswa = Siswa::all();
        return view('siswa.pdf', ['data_siswa' => $data_siswa]);
    }
    public function exportPdf()
    {
        $data_siswa = Siswa::all();
        $pdf = PDF::loadView('siswa.pdf', ['data_siswa' => $data_siswa]);
        return $pdf->download('laporan_data_siswa_' . date('Y-m-d_H-i-s') . '.pdf');
    }

    public function addnilai(Request $request, $id)
    {
        $siswa = Siswa::find($id);
        if ($siswa->mapel()->where('mapel_id', $request->mapel)->exists()) {
            return redirect('siswa/' . $id . '/profile')->with('error', 'Data Mata Pelajaran Sudah Ada');
        }
        $siswa->mapel()->attach($request->mapel, ['nilai' => $request->nilai]);

        return redirect('siswa/' . $id . '/profile')->with('sukses', 'Data Berhasil diupdate');
    }

    public function exportSiswaPdf($id)
    {
        $siswa = Siswa::find($id);
        $mapel = Mapel::all();
        $pdf = PDF::loadView('siswa.siswa-pdf', ['siswa' => $siswa, 'mapel' => $mapel]);
        return $pdf->stream();
    }
}
