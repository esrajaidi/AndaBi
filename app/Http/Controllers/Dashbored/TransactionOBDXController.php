<?php

namespace App\Http\Controllers\Dashbored;

use App\Models\TransactionOBDX;
use App\Http\Controllers\Controller;

use App\Imports\TransactionsOBDXImport;
use App\Models\Branche;

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

class TransactionOBDXController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


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
            ActivityLogger::activity( $e->getMessage().' فشل   تحميل ملف Transactions OBDX  ');

            return redirect()->back();
        }

    }

    public function truncateTable()
    {
        // DB::table('transaction_o_b_d_x_e_s')->truncate();

        ActivityLogger::activity("تم تفريغ الجدول Transactions OBDX بنجاح ");

        Alert::success('تمت عملية  تحميل ملف  بنجاح');

    }

    /**
     * Display the specified resource.
     */
    public function generateReportView(Request $request)
    { 
        $branches = Branche::where('active', 1)->where('branche_number','!=','100')
        ->get();

            $reportType = $request->input('report_type');
            $branches_id = $request->input('branches_id');
       
       
            $query = DB::table('transaction_o_b_d_x_e_s')
            ->select(DB::raw('
                DATE_FORMAT(trn_date, "%Y-%m") as month_year,
                brn,
                
                SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
                SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,
                SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
                SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,

                COUNT(id) as total_transactions
            '))
            ->when($branches_id, function ($query, $branches_id) {
                return $query->where('brn', $branches_id);
            })
            ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'brn')
            ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc')
            ->orderBy('brn', 'asc');
            // Optional: order by branch
                $data = $query->get();



        if ($reportType === 'pdf') {

            return $this->generatePdf($data);
        } elseif ($reportType === 'excel') {
            return $this->generateExcel($data);
        }

        return view('dashboard.transactionOBDX.report_bybranche')
        ->with('data',$data)
        ->with('branches',$branches)
        ->with('branches_id',$branches_id);
 
        
    }

    protected function generatePdf($data) 
    {
        $fileName="transactionOBDX_bybranche_".str_replace( array( '\'', '/',"-" ), '', Now()->toDateString()).".pdf";
        $title='Transaction OBDX Report Branche';
        ActivityLogger::activity($fileName. "تم تصدير ملف  تحت اسم ");

        $pdf = Pdf::loadView('dashboard.report.transactions_pdf_bybranche', ['data' => $data ,'title'=>$title]);
        
        return $pdf->download($fileName);
    }

    protected function generateExcel($data) 
    {       
   

        $fileName="transactionOBDX_bybranche_".str_replace( array( '\'', '/',"-" ), '', Now()->toDateString()).".xlsx";
        ActivityLogger::activity($fileName. "تم تصدير ملف  تحت اسم ");

        return Excel::download(new \App\Exports\TransactionsByBranche($data), $fileName);
    }
    /**
     * Show the form for editing the specified resource.
     */


     public function generateReportViewAll(Request $request)
     { 
         
     
 
             $reportType = $request->input('report_type');
             $query = DB::table('transaction_o_b_d_x_e_s')
             ->select(DB::raw('
                 DATE_FORMAT(trn_date, "%Y-%m") as month_year,
                SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
                SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,

                 SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
                 SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,

                COUNT(id) as total_transactions
             '))
             
             ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'))
             ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc');
         
         $data = $query->get();
 
 
         
 
 
         if ($reportType === 'pdf') {
             return $this->generatePdfALL($data);
         } elseif ($reportType === 'excel') {
             return $this->generateExcelALL($data);
         }
 
 
 
 
 
          
         return view('dashboard.transactionOBDX.report')
         ->with('data',$data);
  
         
     }
     protected function generatePdfALL($data) 
     {
        $fileName="transactionOBDX_".str_replace( array( '\'', '/',"-" ), '', Now()->toDateString()).".pdf";
        $title='Transaction OBDX ';
        ActivityLogger::activity($fileName. "تم تصدير ملف  تحت اسم ");

         $pdf = Pdf::loadView('dashboard.report.transactions_pdf', ['data' => $data ,'title'=>$title]);

         return $pdf->download($fileName);
     }
 
     protected function generateExcelALL($data) 
     {       
    
 
         $fileName="transactionOBDX_".str_replace( array( '\'', '/',"-" ), '', Now()->toDateString()).".xlsx";
         ActivityLogger::activity($fileName. "تم تصدير ملف  تحت اسم ");

         return Excel::download(new \App\Exports\Transactions($data), $fileName);
     }
}
