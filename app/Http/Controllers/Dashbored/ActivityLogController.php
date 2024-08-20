<?php

namespace App\Http\Controllers\Dashbored;

use App\Http\Controllers\Controller;

use App\Models\User;
use App\Services\SmsApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
class ActivityLogController extends Controller
{
   

    private $sms;

    public function __construct(SmsApiService $api)
    {
        $this->sms = $api;
        $this->middleware('auth');
        $this->middleware('permission:laravel-logger', ['only' => ['index']]);

        
    }


    public function index(Request $request)
    {

        
        if($request->ajax()){

        
        $data = DB::table('laravel_logger_activity')->orderBy('id','DESC')->select('*');
        return DataTables::of($data)
        ->addColumn('username', function ($data) {
                $user=User::find($data->userId);
                    return $user->username;
                
        })
        ->rawColumns(['username'])
         ->make(true);

        }
        return view('dashboard.laravel_logger_activity.index');



    }

    



    


}
