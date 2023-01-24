<?php

namespace App\Exports;

use App\Models\TestingDetil;
use Maatwebsite\Excel\Concerns\FromCollection;

class HasilExport implements FromCollection
{
    protected $test_id;

    public function __construct($test_id)
    {
        $this->test_id = $test_id;
    }

    public function collection()
    {

        $data =  TestingDetil::from('testing_detils as a')
            ->join('hasils as b', 'a.id', 'b.testing_detil_id')
            ->where('a.testing_id', $this->test_id)
            ->get(['a.post', 'a.username_twitter', 'b.kalimat', 'b.kategori']);

        return $data;
    }
}
