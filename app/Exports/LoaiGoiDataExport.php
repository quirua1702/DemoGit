<?php

namespace App\Exports;

use App\Models\LoaiGoiData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoaiGoiDataExport implements FromCollection, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'tenloai',
            'tenloai_slug',
            //'hinhanh',
        ];
    }
    public function map($row): array
    {
        return [
            $row->tenloai,
            $row->tenloai_slug,
            //$row->hinhanh,
        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }

    public function collection()
    {
        return LoaiGoiData::all();
    }

}
