<?php

namespace App\Http\Controllers\Dashbored;
use App\Classes\HelperC;
use App\Http\Controllers\Controller;
use App\Models\Branche;
use App\Models\ATMFileUpload;
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
use App\Imports\ATMFileUploadImport;
use App\Exports\BranchReportExport;

class ATMFileUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }


    public function index(Request $request)
    {

       
        if ($request->ajax()) {
            $data = ATMFileUpload::latest()->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if (!empty($request->terminal_id)) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    return Str::contains($row['terminal_id'], $request->get('terminal_id')) ? true : false;
                    });
                }

   
    })
 
    ->make(true);
    }
       return view('dashboard.aTMFileUpload.index');
}

   public function uplode()
   {



        return view('dashboard.aTMFileUpload.uplode');

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
                $import = new ATMFileUploadImport;
                Excel::import($import, $request->file('file'));

                // All data is now in $import->data
                $data = $import->data;
            
                // You can now process the $data array as needed
                // For example, you could insert it into the database:
                foreach ($data as $record) {
                    // Assuming ATMFileUpload is the model
                    ATMFileUpload::create($record);
                }
                          
            });
            
            ActivityLogger::activity($fileName.'تمت عملية  تحميل ملف ATM File Upload  بنجاح');

            Alert::success('تمت عملية  تحميل ملف  بنجاح');

            return redirect('a_t_m_file_uploads');
        } catch (\Exception $e) {
            Alert::warning($e->getMessage());
            ActivityLogger::activity( $e->getMessage().' فشل   تحميل ملف ATM File Upload  ');

            return redirect()->back();
        }

    }
    public function export()
    {
        $data= DB::table('a_t_m_file_uploads')
            ->select(
                DB::raw('YEAR(processing_date) as year'),
                DB::raw('MONTH(processing_date) as month'),
                'terminal_id',
                'terminal_name',
                DB::raw('SUM(total_amount) as total_amount'),
                DB::raw('SUM(tot_fee) as tot_fee'),
                DB::raw('SUM(bank_fee) as bank_fee')
            )
            ->groupBy(DB::raw('YEAR(processing_date)'), DB::raw('MONTH(processing_date)'), 'terminal_id','terminal_name')
            ->orderBy(DB::raw('MONTH(processing_date)'), 'asc')
            ->orderBy('terminal_id', 'asc')
            ->get();

        return Excel::download(new BranchReportExport($data), 'ATM_branch_monthly_report.xlsx');
    }
    /**
     * Display the specified resource.
     */
  

  


  

 
}
