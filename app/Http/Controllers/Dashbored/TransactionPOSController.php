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
        if (!empty($request->branch_number)) {
            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
            return Str::contains($row['branch_number'], $request->get('branch_number')) ? true : false;
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

    public function generateReportView(Request $request)
    { 
        $branches = Branche::where('active', 1)->where('branche_number','!=','100')
        ->get();

            $reportType = $request->input('report_type');
            $branches_id = $request->input('branches_id');
            $query = DB::table('transaction_p_o_s')
            ->select(
                'branch_number',
                DB::raw('DATE_FORMAT(processing_date, "%Y-%m") as month_year'),
                DB::raw('SUM(total_amount) as total_amount_sum'),
                DB::raw('SUM(net_amount) as net_amount_sum'),
            
                DB::raw('SUM((total_amount - net_amount) * 0.25) as total_branch_amount')
            )
               ->when($branches_id, function ($query, $branches_id) {
                return $query->where('branch_number', $branches_id);
            })
            ->groupBy('branch_number', 'month_year')
            ->orderBy('branch_number', 'asc');

    
       
                $data = $query->get();



        if ($reportType === 'pdf') {

            return $this->generatePdf($data);
        } elseif ($reportType === 'excel') {
            return $this->generateExcel($data);
        }

        return view('dashboard.transactionPOS.report_bybranche')
        ->with('data',$data)
        ->with('branches',$branches)
        ->with('branches_id',$branches_id);
 
        
    }

    protected function generatePdf($data) 
    {
        $fileName="transactionPOS_bybranche_".str_replace( array( '\'', '/',"-" ), '', Now()->toDateString()).".pdf";
        $title='Transaction POS Report Branche';
        ActivityLogger::activity($fileName. "تم تصدير ملف  تحت اسم ");

        $pdf = Pdf::loadView('dashboard.report.transactions_POS_bybranche', ['data' => $data ,'title'=>$title]);
        
        return $pdf->download($fileName);
    }

    protected function generateExcel($data) 
    {       
   

        $fileName="transactionPOS_bybranche_".str_replace( array( '\'', '/',"-" ), '', Now()->toDateString()).".xlsx";
        ActivityLogger::activity($fileName. "تم تصدير ملف  تحت اسم ");

        return Excel::download(new \App\Exports\TransactionsPOSByBranche($data), $fileName);
    }

    public function generateReportViewAll(Request $request)
    { 
        
    

            $reportType = $request->input('report_type');
            $query = DB::table('transaction_p_o_s')
            ->select(
               
                DB::raw('DATE_FORMAT(processing_date, "%Y-%m") as month_year'),
                DB::raw('SUM(total_amount) as total_amount_sum'),
                DB::raw('SUM(net_amount) as net_amount_sum'),
            
                DB::raw('SUM((total_amount - net_amount) * 0.25) as total_branch_amount')
            )
              
            ->groupBy(DB::raw('DATE_FORMAT(processing_date, "%Y-%m")'))
            ->orderBy(DB::raw('DATE_FORMAT(processing_date, "%Y-%m")'), 'asc');
          
        
        $data = $query->get();


        


        if ($reportType === 'pdf') {
            return $this->generatePdfALL($data);
        } elseif ($reportType === 'excel') {
            return $this->generateExcelALL($data);
        }





         
        return view('dashboard.transactionPOS.report')
        ->with('data',$data);
 
        
    }
    protected function generatePdfALL($data) 
    {
       $fileName="transactionPOS_".str_replace( array( '\'', '/',"-" ), '', Now()->toDateString()).".pdf";
       $title='Transaction POS ';
       ActivityLogger::activity($fileName. "تم تصدير ملف  تحت اسم ");

        $pdf = Pdf::loadView('dashboard.report.transactions_POS_pdf', ['data' => $data ,'title'=>$title]);

        return $pdf->download($fileName);
    }

    protected function generateExcelALL($data) 
    {       
   

        $fileName="transactionPOS_".str_replace( array( '\'', '/',"-" ), '', Now()->toDateString()).".xlsx";
        ActivityLogger::activity($fileName. "تم تصدير ملف  تحت اسم ");

        return Excel::download(new \App\Exports\Transactions($data), $fileName);
    }
}
