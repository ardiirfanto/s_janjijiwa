<?php

namespace App\Http\Controllers;

use App\Models\Testing;
use App\Models\TestingDetil;
use App\Services\TwitterApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class TestingDetilController extends Controller
{

    function view($test_id)
    {
        $testing = Testing::find($test_id);
        $data = TestingDetil::where('testing_id', $test_id)->get();

        $params = [
            'test' => $testing,
            'data' => $data,
        ];

        return view('pages.uji.testing.detil', $params);
    }
    function get(Request $req)
    {
        DB::beginTransaction();
        try {
            $req->validate([
                'test_id' => 'required',
                'keywords' => 'required|string',
                'qty' => 'required',
            ]);

            $get_detail = TestingDetil::where('testing_id', $req->test_id)->get();

            if (count($get_detail) > 0) {
                TestingDetil::where('testing_id', $req->test_id)->delete();
            }

            $get_post = TwitterApiService::get($req->keywords, $req->qty);

            $arr_post = [];

            foreach ($get_post as $post) {

                $row_post = [
                    'testing_id' => $req->test_id,
                    'post' => addslashes($post->post),
                    'username_twitter' => addslashes($post->username),
                ];

                $arr_post[] = $row_post;
            }

            $store = TestingDetil::insert($arr_post);

            if (!$store) {
                DB::rollBack();
                alert()->error('Gagal Mengambil Data');
                return back();
            }

            DB::commit();
            alert()->success('Sukses Mengambil Data');
            return back();
        } catch (\Throwable $e) {
            DB::rollBack();
            alert()->error($e->getMessage());
            return back();
        }
    }

    function clear($test_id)
    {
        $clear = TestingDetil::where('testing_id', $test_id)->delete();
        if (!$clear) {
            alert()->error('Gagal Membersihkan');
            return back();
        }

        alert()->success('Berhasil Membersihkan');
        return back();
    }
}
