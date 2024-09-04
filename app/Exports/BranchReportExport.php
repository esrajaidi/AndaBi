<?php

namespace App\Exports;



use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class BranchReportExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'Year',
            'Month',
            'Terminal ID',
            'Total Fee',
            'Bank Fee',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => '#,##0.000', // Format for Total Amount (Column C)
            'E' => '#,##0.000', // Format for Total Amount (Column C)

                    ];
    }
}
