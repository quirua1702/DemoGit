<?php

namespace App\Imports;

use App\Models\TenGoiData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TenGoiDataImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new TenGoiData([
            'tengoi' => $row['tengoi'],
            'tengoi_slug' => $row['tengoi_slug'],
            //'hinhanh' => $row['hinhanh'],
        ]);
    }
}
