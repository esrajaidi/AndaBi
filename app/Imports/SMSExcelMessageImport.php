<?php

namespace App\Imports;

use App\Models\SMSLogger;
use App\Services\SmsApiService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SMSExcelMessageImport implements ToModel,WithStartRow
{


    protected $messages;

    function __construct($messages) {
            $this->messages = $messages;
    }



    public function model(array $row){


            if($row[0] != null)
            {


            $len=strlen($row[0]);

            (int)$output = substr($row[0], 0, 2);

             if((($output ==91)||($output ==92)||($output ==93)||($output ==94)) && ($len == 9))
                {

                                $smsApiService =new SmsApiService();
                                $response =$smsApiService->sms_messages((string)$row[0],$this->messages);
                                $smslogger = new SMSLogger();
                                $smslogger->phone_number=$row[0];
                                $smslogger->message_text= $this->messages;
                                $smslogger->message_time=Carbon::now();
                                $smslogger->message_status=($response->status()==200)  ? true : false;
                                ActivityLogger::activity($smslogger->phone_number. ":ارسالة رسالة للرقم ");
                                $smslogger->save();

                }
            else
                {

                    $phone_number=substr($row[0], 4);
                    (int)$output = substr($phone_number, 0, 2);
                    $len=strlen($phone_number);
                    if((($output ==91)||($output ==92)||($output ==93)||($output ==94)) && ($len == 9))
                    {

                                    $smsApiService =new SmsApiService();
                                    $response =$smsApiService->sms_messages((string)$phone_number,$this->messages);
                                    $smslogger = new SMSLogger();
                                    $smslogger->phone_number=$row[0];
                                    $smslogger->message_text= $this->messages;
                                    $smslogger->message_time=Carbon::now();
                                    $smslogger->message_status=($response->status()==200)  ? true : false;
                                    ActivityLogger::activity($smslogger->phone_number. ":ارسالة رسالة للرقم ");
                                    $smslogger->save();

                    }else{
                        $smslogger = new SMSLogger();
                    $smslogger->phone_number=$row[0];
                    $smslogger->message_text= $this->messages;
                    $smslogger->message_time=Carbon::now();
                    $smslogger->message_status= false;
                    ActivityLogger::activity($smslogger->phone_number. ":فشلت عملية ارسال رسالة لوجود خطا في الرقم ");
                    $smslogger->save();
                    }


                }

            }






    }

    public function startRow(): int
    {
        return 2;
    }
    public function headingRow(): int
    {
        return 1;
    }



}



