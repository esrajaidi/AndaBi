<?php 
// app/Exports/TransactionsExport.php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Transactions implements FromCollection, WithHeadings, WithColumnFormatting
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
            'Month-Year',
            'Total Credit',
            'Total Debits',
            'Total Amount',
            
            'Total Transactions',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => '#,##0.00', // Format for Total Amount (Column C)
                    ];
    }
}
