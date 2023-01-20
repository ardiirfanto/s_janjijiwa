<?php

namespace App\Http\Controllers;

use App\Models\Testing;
use App\Models\TestingDetil;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Services\NaiveBayesService;

class HasilController extends Controller
{
    function index()
    {

        $testing = Testing::all();

        $params = [
            'testing' => $testing,
            'data' => null,
        ];

        return view('pages.uji.proses.view', $params);
    }

    function view(Request $req)
    {

        $testing = Testing::all();
        $data = TestingDetil::where('testing_id', $req->testing)->get();
        $params = [
            'testing' => $testing,
            'testing_id' => $req->testing,
            'data' => $data
        ];

        return view('pages.uji.proses.view', $params);
    }

    function proses($test_id)
    {
        $dataset = TestingDetil::where('testing_id', $test_id)->get();
        $datatraining = Training::all();
        $hasil = NaiveBayesService::preprocessing($datatraining);

        echo json_encode($hasil);
        exit;
    }
}
