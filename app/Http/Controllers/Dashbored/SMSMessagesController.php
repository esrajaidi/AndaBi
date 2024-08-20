<?php

namespace App\Http\Controllers\Dashbored;

use App\Classes\DaysInfo;
use App\Enums\CustomerStatus;
use App\Http\Controllers\Controller;
use App\Imports\SMSExcelMessage;
use App\Imports\SMSExcelMessageImport;
use App\Models\AccountDetails;
use App\Models\Branche;
use App\Models\Customer;
use App\Models\ReservationCustomer;
use App\Models\SMSLogger;
use App\Services\SmsApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
class SMSMessagesController extends Controller
{
   

    private $sms;

    public function __construct(SmsApiService $api)
    {
        $this->sms = $api;
        $this->middleware('auth');
        $this->middleware('permission:sms-messages', ['only' => ['smsMessages']]);
        $this->middleware('permission:send-sms-messages', ['only' => ['create','store']]);
        $this->middleware('permission:bulk-send-sms-messages', ['only' => ['createbyexcel','storebyexcel']]);

        
    }


    public function index(Request $request)
    {


        return view('dashboard.sms_messages.index');



    }

    public function smsMessages()
    {
            $data = SMSLogger::orderBy('id','DESC')->select('*');
            return DataTables::of($data)
            ->addColumn('message_status', function ($data) {
                
                if($data->message_status==true)
                return '<span class="label label-success">تم إرسال</span>';
                else
                return  '<span class="label label-danger"> لم تتم عملية الإرسال</span>';
            })
            ->rawColumns(['message_status'])
             ->make(true);



        
    }


    public function create()
    {
        return view('dashboard.sms_messages.create');

    }

    public function store(Request $request)
    {
       
        $this->validate($request, [

            'phone_number' => 'required|digits_between:9,9|numeric|starts_with:91,92,94,93',
            'message_text' => ['required'],

        ]);
        try {
            DB::transaction(function () use ($request) {
                $response =$this->sms->sms_messages((string)$request->phone_number,$request->message_text);
                $request = json_decode($response->body(), true);

                $smslogger = new SMSLogger();
                $smslogger->phone_number=$request['phoneNo'];
                $smslogger->message_text= $request['message'];
                $smslogger->message_time=Carbon::now();
                $smslogger->message_status=($response->status()==200)  ? true : false;
                 ActivityLogger::activity($smslogger->phone_number. ":ارسالة رسالة للرقم ");
                $smslogger->save();
            });

            Alert::success('تمت عملية إرسال رسالة بنجاح');
            return redirect()->route('sms_messages');
        } catch (\Exception $e) {

            Alert::warning($e->getMessage());
            ActivityLogger::activity($e->getMessage() . ":فشل عملية إرسال رسالة ");

            return redirect()->back();
        }
    }

    public function createbyexcel()
    {
        ActivityLogger::activity("عرض صفحة ارسال رسالة من خلال تحميل ملف excel ");
        return view('dashboard.sms_messages.create_by_excel');

    }

    public function storebyexcel(Request $request)
    {
       
        $this->validate($request, [
            'file_phone_number' => 'required|mimes:xlsx, xls',
            'message_text' => ['required'],
        ]);
        try {
            DB::transaction(function () use ($request) {


                 Excel::import(new SMSExcelMessageImport($request->message_text),
                 $request->file('file_phone_number'));
                
            });

            Alert::success('تمت عملية إرسال الرسائل بنجاح');
            return redirect()->route('sms_messages');
        } catch (\Exception $e) {

            dd($e);
            Alert::warning($e->getMessage());
            ActivityLogger::activity($e->getMessage() . ":فشل عملية إرسال رسالة ");

            return redirect()->back();
        }
    }


}
