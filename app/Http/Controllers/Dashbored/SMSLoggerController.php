<?php

use App\Http\Controllers\Controller;
use App\Models\Branche;
use App\Models\Customer;
use App\Models\ReservationCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use RealRashid\SweetAlert\Facades\Alert;

class SMSLoggerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permission:branche-list|branche-create|branche-edit|branche-changestatus', ['only' => ['index']]);

    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SMSLogger $sMSLogger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SMSLogger $sMSLogger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SMSLogger $sMSLogger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SMSLogger $sMSLogger)
    {
        //
    }
}
