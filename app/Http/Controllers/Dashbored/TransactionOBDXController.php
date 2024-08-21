<?php

namespace App\Http\Controllers\Dashbored;

use App\Models\TransactionOBDX;
use App\Http\Controllers\Controller;
use App\Imports\LocalBlockListsImport;
use App\Imports\TransactionsOBDXImport;
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

class TransactionOBDXController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:local_block_lists', ['only' => ['local_block_lists']]);


    }


    public function index(Request $request)
    {

        $branches= Branche::all();
    if ($request->ajax()) {
    $data = TransactionOBDX::latest()->get();
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
       return view('dashboard.transactionOBDX.index')->with('branches',$branches);
}

   public function uplode(){



        return view('dashboard.transactionOBDX.uplode');

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
            DB::transaction(function () use ($request,$fileName) {
                Excel::import(new TransactionsOBDXImport, $request->file('file'));
                          
            });
            
            ActivityLogger::activity($fileName.'تمت عملية  تحميل ملف Transactions OBDX  بنجاح');

            Alert::success('تمت عملية  تحميل ملف  بنجاح');

            return redirect('transaction_o_b_d_x_e_s');
        } catch (\Exception $e) {
            Alert::warning($e->getMessage());
            ActivityLogger::activity( $e->getMessage()."فشل تحميل ملف قوائم الحظر المحلية");

            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionOBDX $transactionOBDX)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionOBDX $transactionOBDX)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionOBDX $transactionOBDX)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionOBDX $transactionOBDX)
    {
        //
    }
}
