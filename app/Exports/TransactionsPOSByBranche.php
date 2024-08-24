<?php 
// app/Exports/TransactionsExport.php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class TransactionsPOSByBranche implements FromCollection, WithHeadings, WithColumnFormatting
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
            'Net Amount',
            'Total Branch Amount'

        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => '#,##0.00', // Format for Total Amount (Column C)
            'D' => '#,##0.00', // Format for Total Amount (Column C)
            'E' => '#,##0.00', // Format for Total Amount (Column C)

                    ];
    }
}
