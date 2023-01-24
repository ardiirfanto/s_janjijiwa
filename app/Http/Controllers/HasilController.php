<?php

namespace App\Http\Controllers;

use App\Exports\HasilExport;
use App\Models\Hasil;
use App\Models\Testing;
use App\Models\TestingDetil;
use App\Models\Training;
use Illuminate\Http\Request;
use App\Services\NaiveBayesService;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
        DB::beginTransaction();
        $dataset = TestingDetil::where('testing_id', $test_id)->get();
        $datatraining = Training::all();
        $train_preprocessing = NaiveBayesService::preprocessing($datatraining);

        $arr_train = [];
        foreach ($train_preprocessing['data'] as $key =>  $row) {
            $row_train = [
                "data" => $train_preprocessing['data'][$key],
                "label" => $train_preprocessing['label'][$key],
            ];
            $arr_train[] = $row_train;
        }

        foreach ($arr_train as $row) {
            NaiveBayesService::train($row['data'], $row['label']);
        }

        $classify_preprocessing = NaiveBayesService::preprocessing($dataset, 1);
        $arr_classify = [];
        foreach ($classify_preprocessing['data'] as $key =>  $row) {
            $row_classify = [
                "data" => $classify_preprocessing['data'][$key],
                "username" => $classify_preprocessing['username'][$key],
                "testing_detil_id" => $classify_preprocessing['testing_detil_id'][$key],
            ];
            $arr_classify[] = $row_classify;
        }

        foreach ($arr_classify as $row) {
            $classify =  NaiveBayesService::classify($row['data'], $row['username'], $row['testing_detil_id']);
            $hasil_classify = [
                "testing_detil_id" => $classify['testing_detil_id'],
                "kalimat" => $classify['kalimat'],
                "kategori" => $classify['skor'],
            ];

            $store = Hasil::updateOrInsert(['testing_detil_id' => $classify['testing_detil_id']], $hasil_classify);
        }

        if (!$store) {
            DB::rollBack();
            alert()->error('Gagal Melakukan Klasifikasi');
            return redirect()->back();
        }

        DB::commit();
        alert()->success('Berhasil Melakukan Klasifikasi');
        return redirect()->route('uji.proses.hasil', ['testing_id' => $test_id]);
    }

    function hasil($test_id)
    {

        $testing = Testing::find($test_id);
        $data = TestingDetil::from('testing_detils as a')
            ->join('hasils as b', 'a.id', 'b.testing_detil_id')
            ->where('a.testing_id', $test_id)
            ->get(['a.post', 'a.username_twitter', 'b.kalimat', 'b.kategori']);

        $positif = TestingDetil::from('testing_detils as a')
            ->join('hasils as b', 'a.id', 'b.testing_detil_id')
            ->where('a.testing_id', $test_id)
            ->where('b.kategori', 'Positif')
            ->count();
        $negatif = TestingDetil::from('testing_detils as a')
            ->join('hasils as b', 'a.id', 'b.testing_detil_id')
            ->where('a.testing_id', $test_id)
            ->where('b.kategori', 'Negatif')
            ->count();
        $netral = TestingDetil::from('testing_detils as a')
            ->join('hasils as b', 'a.id', 'b.testing_detil_id')
            ->where('a.testing_id', $test_id)
            ->where('b.kategori', 'Netral')
            ->count();

        $params = [
            'testing' => $testing,
            'data' => $data,
            'positif' => $positif,
            'negatif' => $negatif,
            'netral' => $netral,
        ];

        return view('pages.uji.proses.hasil', $params);
    }

    function export($test_id)
    {

        return Excel::download(new HasilExport($test_id), 'hasil.xlsx');
    }
}
