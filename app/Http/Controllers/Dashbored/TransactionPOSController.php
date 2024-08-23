<?php

namespace App\Http\Controllers\Dashbored;

use App\Models\TransactionPOS;
use App\Http\Controllers\Controller;
use App\Imports\LocalBlockListsImport;
use App\Imports\TransactionsPOSImport;
use App\Models\Branche;
use App\Models\LocalBlockLists;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionPOSController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }


    public function index(Request $request)
    {

        $branches= Branche::all();
    if ($request->ajax()) {
            $data = TransactionPOS::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
        if (!empty($request->brn)) {
            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
            return Str::contains($row['brn'], $request->get('brn')) ? true : false;
            });
         }

   
    })
 
    ->make(true);
    }
       return view('dashboard.transactionPOS.index')->with('branches',$branches);
}

    /**
     * Show the form for creating a new resource.
     */
    public function uplode(){



        return view('dashboard.transactionPOS.uplode');

    }

    public function storeUplode(Request $request)
    {


        $messages = [
            'file.required' => 'الرجاء تحميل ملف ',

        ];
        $this->validate($request, [
            'file' => ['required'],
        ], $messages);


        try {

            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
                // Check if the file name already exists in the database
                $fileExists = TransactionPOS::where('file_name', $fileName)->exists();

                if ($fileExists) {
                    Alert::warning("لقد سبق وتم تحميل هذا الملف مسبقا");
                    ActivityLogger::activity($fileName."لقد سبق وتم تحميل هذا الملف مسبقا");
                    return redirect()->back();

                }

            DB::transaction(function () use ($request,$fileName) {

            Excel::import(new TransactionsPOSImport($fileName), $request->file('file'));
                          
            });
            
            ActivityLogger::activity($fileName.'تمت عملية  تحميل ملف Transactions POS  بنجاح');

            Alert::success('تمت عملية  تحميل ملف  بنجاح');

            return redirect('transaction_p_o_s');
        } catch (\Exception $e) {
            Alert::warning($e->getMessage());
            ActivityLogger::activity( $e->getMessage().' فشل   تحميل ملف Transactions POS  ');

            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionPOS $transactionPOS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionPOS $transactionPOS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionPOS $transactionPOS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionPOS $transactionPOS)
    {
        //
    }
}
