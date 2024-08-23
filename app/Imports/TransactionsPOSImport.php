<?php

namespace App\Imports;

use App\Models\TransactionOBDX;
use App\Models\TransactionPOS;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Carbon\Carbon;
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

          
        return new TransactionPOS([
            'merchant_no'         => $row[0], 
            'merchant_name'       => trim($row[1]), 
            'banking_account_no'  => $row[2], 
            'bank_name'           => trim($row[3]), 
            'branch_number'         =>substr(trim($row[2]), 0, 3) , 

            'branch_name'         => trim($row[4]), 
            'net_amount'          => $row[5], 
            'processing_date'     => Carbon::createFromFormat('m/d/Y h:i:s A', $row[6]), 
            'total_amount'        => $row[7], 
            'trx_no'              => $row[8], 
            'file_name'           => $this->fileName, 
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
