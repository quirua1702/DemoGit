<?php

namespace App\Exports;

use App\Models\GoiData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;

class GoiDataExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'loaigoidata_id',
            'tengoidata_id',
            'tengoicuoc',
            'tengoicuoc_slug',
            'soluong',
            'dongia',
            'hinhanh',
        ];
    }
    public function map($row): array
    {
        return [
            $row->loaigoidata_id,
            $row->tengoidata_id,
            $row->tengoicuoc,
            $row->tengoicuoc_slug,
            $row->soluong,
            $row->dongia,
            $row->hinhanh,
        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }

    public function collection()
    {
        return GoiData::all();
    }

}
