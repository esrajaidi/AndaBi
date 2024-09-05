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
            'Termina Name',
            'Total Amount',
            'Total Fee',
            'Bank Fee',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => '#,##0.000', // Format for Total Amount (Column C)
            'F' => '#,##0.000', // Format for Total Amount (Column C)
            'G' => '#,##0.000', // Format for Total Amount (Column C)


                    ];
    }
}
