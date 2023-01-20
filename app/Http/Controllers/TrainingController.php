<?php

namespace App\Http\Controllers;

use App\Imports\TrainingImport;
use App\Models\Training;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TrainingController extends Controller
{
    function index()
    {
        $data = Training::all();

        $params = [
            'data' => $data
        ];

        return view('pages.training.view', $params);
    }
    function store(Request $req)
    {
        $req->validate([
            'kalimat' => 'required'
        ]);

        $store = Training::insert([
            'kalimat' => addslashes($req->kalimat),
            'kategori' => $req->kategori
        ]);

        if (!$store) {
            alert()->error('Gagal Simpan');
            return back();
        }

        alert()->success('Berhasil Simpan');
        return back();
    }
    function import(Request $req)
    {
        try {
            $req->validate([
                'file' => 'required|max:2048'
            ]);

            $file = $req->file('file');
            $filename = rand() . $file->getClientOriginalName();
            $file->move('docs/excel', $filename);

            $import = Excel::import(new TrainingImport, public_path('/docs/excel/' . $filename));

            if (!$import) {
                alert()->error('Gagal Import');
                return back();
            }

            alert()->success('Berhasil Import Data Training');
            return back();
        } catch (\Throwable $e) {
            alert()->error($e->getMessage());
            return back();
        }
    }
    function clear()
    {
        $clear = Training::truncate();
        if (!$clear) {
            alert()->error('Gagal Membersihkan');
            return back();
        }

        alert()->success('Berhasil Membersihkan');
        return back();
    }
    function delete($id)
    {
        $delete = Training::find($id)->delete();
        if (!$delete) {
            alert()->error('Gagal Hapus');
            return back();
        }

        alert()->success('Berhasil Hapus');
        return back();
    }
}
