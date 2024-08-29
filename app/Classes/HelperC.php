<?php
namespace App\Classes;
use Carbon\Carbon;
use Nette\Utils\DateTime;
use jeremykenedy\LaravelLogger\App\Http\Traits\ActivityLogger;
use Illuminate\Support\Facades\DB;
class HelperC {
    


    const year = 2024;


     public static  function months(){

          $months = [
               'January', 'February', 'March', 'April', 'May', 'June', 
               'July', 'August', 'September', 'October', 'November', 'December'
           ];
           
          return $months;
     }

     public static  function branches(){

          return ['فرع زليتن','فرع طريق الشط','الرئيسي','مصراتة','فرع برج طرابلس'];
     }

     
    
          public static function get_transaction_card_issuing_fees($month_year){
               return DB::table('transaction_card_issuing_fees')
               ->select(DB::raw('
               DATE_FORMAT(trn_date, "%Y-%m") as month_year,
               SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
               SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,
               SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
               SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,
               COUNT(id) as total_transactions
               '))
               ->when($month_year, function ($query, $month_year) {
               return $query->where(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), $month_year);
               })
               ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'))
               ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc')
               ->first();
          }



          public static function get_transaction_incom_card_fees($month_year){
               return DB::table('transaction_incom_card_fees')
               ->select(DB::raw('
               DATE_FORMAT(trn_date, "%Y-%m") as month_year,
               SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
               SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,
               SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
               SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,
               COUNT(id) as total_transactions
               '))
               ->when($month_year, function ($query, $month_year) {
               return $query->where(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), $month_year);
               })
               ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'))
               ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc')
               ->first();
          }



          public static function get_transaction_card_re_issuing_fees($month_year){
               return DB::table('transaction_card_re_issuing_fees')
               ->select(DB::raw('
               DATE_FORMAT(trn_date, "%Y-%m") as month_year,
               SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
               SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,
               SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
               SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,
               COUNT(id) as total_transactions
               '))
               ->when($month_year, function ($query, $month_year) {
               return $query->where(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), $month_year);
               })
               ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'))
               ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc')
               ->first();
          }
          public static function get_transaction_o_b_d_x_e_s($month_year){
               return DB::table('transaction_o_b_d_x_e_s')
               ->select(DB::raw('
               DATE_FORMAT(trn_date, "%Y-%m") as month_year,
               SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
               SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,
               SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
               SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,
               COUNT(id) as total_transactions
               '))
               ->when($month_year, function ($query, $month_year) {
               return $query->where(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), $month_year);
               })
               ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'))
               ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc')
               ->first();
               }



               public static function get_transaction_o_b_d_x_coms($month_year){
                    return DB::table('transaction_o_b_d_x_coms')
                    ->select(DB::raw('
                    DATE_FORMAT(trn_date, "%Y-%m") as month_year,
                    SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
                    SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,
                    SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
                    SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,
                    COUNT(id) as total_transactions
                    '))
                    ->when($month_year, function ($query, $month_year) {
                    return $query->where(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), $month_year);
                    })
                    ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'))
                    ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc')
                    ->first();
                    }
     

                    
               public static function get_transaction_incom_w_u_s($month_year){
                    return DB::table('transaction_incom_w_u_s')
                    ->select(DB::raw('
                    DATE_FORMAT(trn_date, "%Y-%m") as month_year,
                    SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
                    SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,
                    SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
                    SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,
                    COUNT(id) as total_transactions
                    '))
                    ->when($month_year, function ($query, $month_year) {
                    return $query->where(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), $month_year);
                    })
                    ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'))
                    ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc')
                    ->first();
                    }
                    

                    public static function get_transaction_w_u_s($month_year){
                         return DB::table('transaction_w_u_s')
                         ->select(DB::raw('
                         DATE_FORMAT(trn_date, "%Y-%m") as month_year,
                         SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
                         SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,
                         SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
                         SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,
                         COUNT(id) as total_transactions
                         '))
                         ->when($month_year, function ($query, $month_year) {
                         return $query->where(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), $month_year);
                         })
                         ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'))
                         ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc')
                         ->first();
                         }
                         
                         public static function get_transaction_s_m_s($month_year){
                              return DB::table('transaction_s_m_s')
                              ->select(DB::raw('
                              DATE_FORMAT(trn_date, "%Y-%m") as month_year,
                              SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
                              SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,
                              SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
                              SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,
                              COUNT(id) as total_transactions
                              '))
                              ->when($month_year, function ($query, $month_year) {
                              return $query->where(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), $month_year);
                              })
                              ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'))
                              ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc')
                              ->first();
                              }


                              public static function get_transaction_s_m_s_c_o_m_s($month_year){
                                   return DB::table('transaction_s_m_s_c_o_m_s')
                                   ->select(DB::raw('
                                   DATE_FORMAT(trn_date, "%Y-%m") as month_year,
                                   SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
                                   SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,
                                   SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
                                   SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,
                                   COUNT(id) as total_transactions
                                   '))
                                   ->when($month_year, function ($query, $month_year) {
                                   return $query->where(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), $month_year);
                                   })
                                   ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'))
                                   ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc')
                                   ->first();
                                   }


                               
                                   
                                   public static function get_transaction_a_t_m_s($month_year){
                                        return DB::table('transaction_a_t_m_s')
                                        ->select(DB::raw('
                                        DATE_FORMAT(trn_date, "%Y-%m") as month_year,
                                        SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
                                        SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,
                                        SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
                                        SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,
                                        COUNT(id) as total_transactions
                                        '))
                                        ->when($month_year, function ($query, $month_year) {
                                        return $query->where(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), $month_year);
                                        })
                                        ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'))
                                        ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc')
                                        ->first();
                                        }


                                        
                                        public static function get_transaction_re_issuing_pin_fees($month_year){
                                             return DB::table('transaction_re_issuing_pin_fees')
                                             ->select(DB::raw('
                                             DATE_FORMAT(trn_date, "%Y-%m") as month_year,
                                             SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) as total_credits,
                                             SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_debits,
                                             SUM(CASE WHEN drcr = "C" THEN lcy_amount ELSE 0 END) -
                                             SUM(CASE WHEN drcr = "D" THEN lcy_amount ELSE 0 END) as total_amount,
                                             COUNT(id) as total_transactions
                                             '))
                                             ->when($month_year, function ($query, $month_year) {
                                             return $query->where(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), $month_year);
                                             })
                                             ->groupBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'))
                                             ->orderBy(DB::raw('DATE_FORMAT(trn_date, "%Y-%m")'), 'asc')
                                             ->first();
                                             }
     
                                        
                                   public static function convertMonthYear($monthYearString) {
                         // Create a DateTime instance from the input string
                         $date = DateTime::createFromFormat('Y-F', $monthYearString);
                         
                         // Check if the date was created successfully
                         if ($date) {
                         // Format the date to 'Y-m' (e.g., '2024-08')
                         return $date->format('Y-m');
                         } else {
                         // Handle the error case if the input string is invalid
                         ActivityLogger::activity('Invalid month-year format. Please use "YYYY-Month" format.');

                         }
                    }
      
    
      

    
}
