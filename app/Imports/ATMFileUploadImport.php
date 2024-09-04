<?php

namespace App\Imports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ATMFileUploadImport implements ToCollection
{
    public function chunkSize(): int
    {
        return 1000; // Process 1000 rows at a time
    }
    public $data = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            // Skip the header row if present
            if ($index === 0) {
                continue;
            }

            $dateString = $row[4]; // Replace with the actual index of the date in your row
            $processingDate = Carbon::createFromFormat('m/d/Y h:i:s A', $dateString);

            $this->data[] = [
                'terminal_id'     => $row[0],
                'terminal_name'   => $row[1],
                'bank_name'       => $row[2],
                'total_amount'    => $row[3],
                'processing_date' => $processingDate,
                'total_amount_1'  => $row[5],
                'trx_no'          => $row[6],
                'tot_fee'         => $row[6] * 5,
                'bank_fee'        => ($row[6] * 5) * 0.40,
            ];
        }
    }
}
