<?php

namespace App\Http\Controllers;

use App\Models\Testing;
use App\Models\TestingDetil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

class TestingController extends Controller
{
    function index()
    {
        $testing = Testing::all();
        $data = [];
        foreach ($testing as $test) {

            $detil = TestingDetil::where('testing_id', $test->id)->get();

            $row = new stdClass;
            $row->id = $test->id;
            $row->nama_testing = $test->nama_testing;
            $row->tgl_testing = $test->tgl_testing;
            $row->data = $detil;

            $data[] = $row;
        }

        $params = [
            'data' => $data
        ];

        return view('pages.uji.testing.view', $params);
    }
    function store(Request $req)
    {
        $req->validate([
            'nama' => 'required|string'
        ]);

        Testing::insert([
            'nama_testing' => $req->nama,
            'tgl_testing' => Carbon::now()
        ]);

        alert()->success('Berhasil Menyimpan');
        return back();
    }
    function update(Request $req)
    {
        $req->validate([
            'id' => 'required',
            'nama' => 'required|string'
        ]);

        $row = Testing::find($req->id);
        $row->timestamps = false;
        $row->nama_testing = $req->nama;
        $row->save();

        alert()->success('Berhasil Mengubah');
        return back();
    }
    function delete($id)
    {
        $delete = Testing::find($id)->delete();
        if (!$delete) {
            alert()->error('Gagal Hapus');
            return back();
        }

        alert()->success('Berhasil Hapus');
        return back();
    }
}
