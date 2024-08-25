<?php

namespace App\Imports;

use App\Models\TransactionOBDX;
use App\Models\TransactionWU;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;

class TransactionsWUImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       
        
    
        $entry_sr_no = $row[15];

        // Check if the `trn_ref_no` already exists
        if (TransactionWU::where('entry_sr_no', $entry_sr_no)->exists()) {

            ActivityLogger::activity("لم يتم ادخال  لوجود entry_sr_no  مسبقا");

            // Skip this row as it already exists
            return null;
        }
        if ($row[3] !='IC109011620') {
          
            ActivityLogger::activity("the entry ac_no is ".$row[3]."not  IC109011620" );
            return null;
        }
          // Convert the date columns from Excel to the format that Laravel expects

          $trnDate = $this->excelSerialToDate($row[10]);
          $valueDate = $this->excelSerialToDate($row[11]);
        return new TransactionWU([
            'trn_ref_no' => $row[0],
            'event' => $row[1],
            'brn' => $row[2],
            'ac_no' => $row[3],
            'ccy' => $row[4],
            'drcr' => $row[5],
            'trn_code' => $row[6],
            'fcy_amount' => $row[7],
            'exch_rate' => $row[8],
            'lcy_amount' => $row[9],
            'trn_date' => $trnDate,
            'value_date' => $valueDate,
            'related_account' => $row[12],
            'maker' => $row[13],
            'checker' => $row[14],
            'entry_sr_no' => $row[15],
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    private function excelSerialToDate($serial)
    {
        if (is_numeric($serial) && $serial > 0) {
            // Convert Excel serial date number to a PHP DateTime
            $unixDate = ($serial - 25569) * 86400;
            return gmdate("Y-m-d", $unixDate);
        }
        return null; // Return null or handle as needed if the value is not valid
    }
    
}
