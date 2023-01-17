<?php

namespace App\Http\Controllers;

use App\Models\KataDihilangkan;
use Illuminate\Http\Request;
use Alert;

class KataDihilangkanController extends Controller
{
    function index()
    {
        $data = KataDihilangkan::all();

        $params = [
            'data' => $data
        ];

        return view('pages.stopwords.view',$params);
    }
    function store(Request $req)
    {
        $store = KataDihilangkan::insert([
            'kata' => $req->kata
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
    }
    function clear()
    {
        $clear = KataDihilangkan::truncate();
        if (!$clear) {
            alert()->error('Gagal Membersihkan');
            return back();
        }

        alert()->success('Berhasil Membersihkan');
        return back();
    }
    function delete($id)
    {
        $delete = KataDihilangkan::find($id)->delete();
        if (!$delete) {
            alert()->error('Gagal Hapus');
            return back();
        }

        alert()->success('Berhasil Hapus');
        return back();
    }
}
