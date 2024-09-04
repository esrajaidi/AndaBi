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

     
     public static  function branchesgetname($number){

          if($number=='10000004')
          return'فرع زليتن';
               else
               if($number=='10000005')
                    return 'فرع طريق الشط';
               else if($number=='10000003')
                    return'فرع الرئيسي';
               else if($number=='10000003')
               return'فرع مصراتة';
               else
               'فرع برج طرابلس';

     }
     public static function get_transaction_master_card_coin_purchase_request_commissions($month_year){
          return DB::table('transaction_master_card_coin_purchase_request_commissions')
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

     public static function get_transaction_matser_point_o_f_sale_purchase_commissions($month_year){
          return DB::table('transaction_matser_point_o_f_sale_purchase_commissions')
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
     public static function get_transaction_a_t_m_o_f_f_u_s_fees($month_year){
          return DB::table('transaction_a_t_m_o_f_f_u_s_fees')
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
     public static function get_transaction_markup_fees($month_year){
          return DB::table('transaction_markup_fees')
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
     public static function get_transaction_master_a_t_m_s($month_year){
          return DB::table('transaction_master_a_t_m_s')
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
     public static function get_transaction_master_card_issuing_fees($month_year){
          return DB::table('transaction_master_card_issuing_fees')
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
    
     public static function get_transaction_master_card_charging_fees($month_year){
          return DB::table('transaction_master_card_charging_fees')
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
     public static function get_transaction_master_card_mangment_fees($month_year){
          return DB::table('transaction_master_card_mangment_fees')
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
     
                       
                                             public static function get_transaction_p_o_s($month_year){


                                                  return  DB::table('transaction_p_o_s')
                                                  ->select(
                                                      DB::raw('DATE_FORMAT(processing_date, "%Y-%m") as month_year'),
                                                      DB::raw('SUM(total_amount) as total_amount_sum'),
                                                      DB::raw('SUM(net_amount) as net_amount_sum'),
                                                      DB::raw('SUM((total_amount - net_amount) * 0.25) as total_branch_amount')
                                                  )
                                                  ->where(DB::raw('DATE_FORMAT(processing_date, "%Y-%m")'), $month_year)
                                                  ->groupBy(DB::raw('DATE_FORMAT(processing_date, "%Y-%m")'))
                                                  ->orderBy(DB::raw('DATE_FORMAT(processing_date, "%Y-%m")'), 'asc')
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
