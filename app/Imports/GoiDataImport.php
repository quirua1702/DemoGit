<?php

namespace App\Imports;

use App\Models\GoiData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GoiDataImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new GoiData([
            'loaigoidata_id' => $row['loaigoidata_id'],
            'tengoidata_id' => $row['tengoidata_id'],
            'tengoicuoc' => $row['tengoicuoc'],
            'tengoicuoc_slug' => $row['tengoicuoc_slug'],
            'thongtingoicuoc' => $row['thongtingoicuoc'],
            'dongia' => $row['dongia'],
            'hinhanh' => $row['hinhanh'],
        ]);
    }
}
