<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

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
        return view('siswa.profile', ['siswa' => $siswa]);
    }
}
