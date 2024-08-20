<?php

namespace App\Exports;

use App\Models\LocalBlockLists;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LocalBlockListsExport implements FromCollection ,WithHeadings
{
    use Exportable;


    

    
    public function map($data): array
    {   
         return $data;
    }
    // set the collection of members to export
    public function collection()
    {   

        $local_block_lists = LocalBlockLists::query();
        $local_block_lists = $local_block_lists->get();
        
        return $local_block_lists->map(function($data,$key){
            return [
                'row_number'       =>  $key + 1,
                'statement'         =>  $data->statement,
                'hiddenBy'=>  $data->hiddenBy,
                'dateofreceivedMessage'  =>  $data->dateofreceivedMessage,
                'index' =>  $data->index,
                'notes' =>  $data->notes,

            ];
        });
    }
    // public function collection()
    // {

    //         //  DB::statement(DB::raw('set @row_number = 0'),);

    //         // DB::statement( DB::raw( 'SET @row_number := 0'));
            
             
    //         return DB::table('local_block_lists')
    //         ->select( DB::raw("(@row_number:=@row_number + 1) AS num"),
    //             'statement','hiddenBy','dateofreceivedMessage','index' ,'notes')
    //         ->get();
    

           
       

        

    // }

    public function headings(): array
    {
        return ["ر.ت", "البيان","الجهة التي أصدرت التجميد", "تاريخ الرسالة الواردة",'الرقم الاشاري','الملاحظات'];
    }
}
