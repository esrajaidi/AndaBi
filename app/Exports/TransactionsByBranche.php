<?php 
// app/Exports/TransactionsExport.php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TransactionsByBranche implements FromCollection, WithHeadings, WithColumnFormatting
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
            'Branch',
            'Total Amount',
            'Total Transactions',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => '#,##0.00', // Format for Total Amount (Column C)
                    ];
    }
}
