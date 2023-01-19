<?php

namespace App\Imports;

use App\Models\Training;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TrainingImport implements ToCollection,WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            Training::insert([
                'kalimat' => $row['kalimat'],
                'kategori' => $row['kategori']
            ]);
        }
    }
}
