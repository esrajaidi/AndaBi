<?php

namespace App\Http\Controllers\Dashbored;

use App\BranchCard;
use App\Classes\DaysInfo;
use App\Classes\HelperC;
use App\CompanyStock;
use App\Enums\CustomerStatus;
use App\Http\Controllers\Controller;
use App\Models\AccountDetails;
use App\Models\Branche;
use App\Models\ReservationCountAday;
use App\Models\ReservationCustomer;
use App\Models\SMSLogger;
use App\Services\SmsApiService;
use App\TotalStock;
use App\Models\Customer;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Permission;
USE Illuminate\Support\Facades\DB;
use App\Exports\FinancialData_Export;
use Maatwebsite\Excel\Facades\Excel;

class DashboradController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $months = HelperC::months();
        $year=HelperC::year;
         return view('dashboard.home',compact('months', 'year'));
        
    }

    public function index2()
    {

        $months = HelperC::months();
        $year=HelperC::year;
        return view('dashboard.home2',compact('months', 'year'));
        
    }


    

}
