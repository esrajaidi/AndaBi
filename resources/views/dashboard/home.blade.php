@extends('layouts.dashboard_app')
@section('title', 'الرئسية')

@section('content')
<div class="row small-spacing">
    <div class="col-xs-12">
       
      
            <div class="container my-5">
                <h2 class="text-center">Financial Data </h2>
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Month</th>
                            <th>Card issuing fees</th>
                            <th>OBDX fees</th>
                            <th>Card Using Fee</th>
                            <th>ATM Fees</th>
                            <th>Total Fee</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($months as $month)
<?php $monthYearString = \App\Classes\HelperC::year ."-".$month;
        $month_year = \App\Classes\HelperC::convertMonthYear($monthYearString); 
      $transaction_card_issuing_fees=  \App\Classes\HelperC::get_transaction_card_issuing_fees($month_year);
     
      $transaction_o_b_d_x_e_s=  \App\Classes\HelperC::get_transaction_o_b_d_x_e_s($month_year);

     ?>
                        <tr>
                            <td>{{ $month }}</td>
                            <td>{{( $transaction_card_issuing_fees!= null) ? $transaction_card_issuing_fees->total_amount : 0}}
                            </td>
                            <td>{{( $transaction_o_b_d_x_e_s!= null) ? $transaction_o_b_d_x_e_s->total_amount : 0}}
                                <td>0.000</td>
                            <td>11,974.900</td>
                            <td>129,377.631</td>
                        
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        
       
        
       
    </div>

 

 
   
     
    </div>

@endsection
