<?php

namespace App\Imports;

use App\Models\TransactionOBDX;
use App\Models\TransactionPOS;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;

class TransactionsPOSImport implements ToModel,WithStartRow
{
    protected $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function model(array $row)
    {
    
        // $entry_sr_no = $row[15];

        // Check if the `trn_ref_no` already exists
        // if (TransactionOBDX::where('entry_sr_no', $entry_sr_no)->exists()) {

        //     ActivityLogger::activity("لم يتم ادخال  لوجود entry_sr_no  مسبقا");

        //     // Skip this row as it already exists
        //     return null;
        // }
        // if ($row[3] !='IC109012601') {
          
        //     ActivityLogger::activity("the entry ac_no is ".$row[3]."not  IC109012601" );
        //     return null;
        // }
          // Convert the date columns from Excel to the format that Laravel expects

          $trnDate = $this->excelSerialToDate($row[10]);
          $valueDate = $this->excelSerialToDate($row[11]);
        return new TransactionPOS([
            'merchant_no'         => $row['merchant_no'],
            'merchant_name'       => $row['merchant_name'],
            'banking_account_no'  => $row['banking_account_no'],
            'bank_name'           => $row['bank_name'],
            'branch_name'         => $row['branch_name'],
            'net_amount'          => $row['net_amount'],
            'processing_date'     => $row['processing_date'],
            'total_amount'        => $row['total_amount'],
            'trx_no'              => $row['trx_no'],
            'file_name'           => $this->fileName, // Use the passed file name
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
