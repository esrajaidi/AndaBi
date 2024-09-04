@extends('layouts.dashboard_app')
@section('title', 'الرئسية')

@section('content')
<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="container my-5">
            <h2 class="text-center">Financial Data</h2>
            <a href="{{ url('/export-financial-data') }}" class="btn btn-success mb-3">Export to Excel</a>
            <br>
            <br>
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Month</th>
                        <th>Card Issuing Fees</th>
                        <th>Card Income Fees</th>
                        <th>Card Reissuing Fees</th>
                        <th>Pin Reissuing Fees</th>
                        <th>OBDX Fees</th>
                        <th>OBDX Company Fees</th>
                        <th>Income WU Fees</th>
                        <th>Outgoing WU Fees</th>
                        <th>SMS Fees</th>
                        <th>SMS Company Fees</th>
                        <th>ATM Fees</th>
                        <th>POS Fees</th>

                    </tr>
                </thead>
                <tbody>
                    @php
                        $total_card_issuing_fees = 0;
                        $total_incom_card_fees = 0;
                        $total_card_re_issuing_fees = 0;
                        $total_re_issuing_pin_fees = 0;
                        $total_o_b_d_x_e_s = 0;
                        $total_o_b_d_x_coms = 0;
                        $total_incom_w_u_s = 0;
                        $total_w_u_s = 0;
                        $total_s_m_s = 0;
                        $total_s_m_s_c_o_m_s = 0;
                        $total_a_t_m_s=0;
                        $total_p_o_s=0;
                    @endphp
                    @foreach ($months as $month)
                        @php
                            $monthYearString = \App\Classes\HelperC::year . "-" . $month;
                            $month_year = \App\Classes\HelperC::convertMonthYear($monthYearString);
                            
                            $transaction_card_issuing_fees = \App\Classes\HelperC::get_transaction_card_issuing_fees($month_year);
                            $transaction_incom_card_fees = \App\Classes\HelperC::get_transaction_incom_card_fees($month_year);
                            $transaction_card_re_issuing_fees = \App\Classes\HelperC::get_transaction_card_re_issuing_fees($month_year);
                            $transaction_o_b_d_x_e_s = \App\Classes\HelperC::get_transaction_o_b_d_x_e_s($month_year);
                            $transaction_o_b_d_x_coms = \App\Classes\HelperC::get_transaction_o_b_d_x_coms($month_year);
                            $transaction_incom_w_u_s = \App\Classes\HelperC::get_transaction_incom_w_u_s($month_year);
                            $transaction_w_u_s = \App\Classes\HelperC::get_transaction_w_u_s($month_year);
                            $transaction_s_m_s = \App\Classes\HelperC::get_transaction_s_m_s($month_year);
                            $transaction_s_m_s_c_o_m_s = \App\Classes\HelperC::get_transaction_s_m_s_c_o_m_s($month_year);
                            $transaction_re_issuing_pin_fees = \App\Classes\HelperC::get_transaction_re_issuing_pin_fees($month_year);
                            $transaction_a_t_m_s = \App\Classes\HelperC::get_transaction_a_t_m_s($month_year);

                            $transaction_p_o_s = \App\Classes\HelperC::get_transaction_p_o_s($month_year);

                            // Accumulate totals
                            $total_card_issuing_fees += $transaction_card_issuing_fees->total_amount ?? 0;
                            $total_incom_card_fees += $transaction_incom_card_fees->total_amount ?? 0;
                            $total_card_re_issuing_fees += $transaction_card_re_issuing_fees->total_amount ?? 0;
                            $total_re_issuing_pin_fees += $transaction_re_issuing_pin_fees->total_amount ?? 0;
                            $total_o_b_d_x_e_s += $transaction_o_b_d_x_e_s->total_amount ?? 0;
                            $total_o_b_d_x_coms += $transaction_o_b_d_x_coms->total_amount ?? 0;
                            $total_incom_w_u_s += $transaction_incom_w_u_s->total_amount ?? 0;
                            $total_w_u_s += $transaction_w_u_s->total_amount ?? 0;
                            $total_s_m_s += $transaction_s_m_s->total_amount ?? 0;
                            $total_s_m_s_c_o_m_s += $transaction_s_m_s_c_o_m_s->total_amount ?? 0;
                            $total_a_t_m_s += $transaction_a_t_m_s->total_amount ?? 0;

                            $total_p_o_s += $transaction_p_o_s->total_amount ?? 0;

                        @endphp
                        <tr>
                            <td>{{ $month }}</td>
                            <td>{{ $transaction_card_issuing_fees->total_amount ?? 0 }}</td>
                            <td>{{ $transaction_incom_card_fees->total_amount ?? 0 }}</td>
                            <td>{{ $transaction_card_re_issuing_fees->total_amount ?? 0 }}</td>
                            <td>{{ $transaction_re_issuing_pin_fees->total_amount ?? 0 }}</td>
                            <td>{{ $transaction_o_b_d_x_e_s->total_amount ?? 0 }}</td>
                            <td>{{ $transaction_o_b_d_x_coms->total_amount ?? 0 }}</td>
                            <td>{{ $transaction_incom_w_u_s->total_amount ?? 0 }}</td>
                            <td>{{ $transaction_w_u_s->total_amount ?? 0 }}</td>
                            <td>{{ $transaction_s_m_s->total_amount ?? 0 }}</td>
                            <td>{{ $transaction_s_m_s_c_o_m_s->total_amount ?? 0 }}</td>
                            <td>{{ $transaction_a_t_m_s->total_amount ?? 0 }}</td>

                            <td>{{ $transaction_p_o_s->total_amount ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Total</th>
                    <th>{{ $total_card_issuing_fees }}</th>
                    <th>{{ $total_incom_card_fees }}</th>
                    <th>{{ $total_card_re_issuing_fees }}</th>
                    <th>{{ $total_re_issuing_pin_fees }}</th>
                    <th>{{ $total_o_b_d_x_e_s }}</th>
                    <th>{{ $total_o_b_d_x_coms }}</th>
                    <th>{{ $total_incom_w_u_s }}</th>
                    <th>{{ $total_w_u_s }}</th>
                    <th>{{ $total_s_m_s }}</th>
                    <th>{{ $total_s_m_s_c_o_m_s }}</th>
                    <th>{{ $total_a_t_m_s }}</th>
                    <th>{{ $total_p_o_s }}</th>

                </tr>
            </tfoot>
            </table>
        </div>
    </div>
    <br>
    @include('dashboard.transactionCardIssuingFees.chart', ['months' => $months])
    @include('dashboard.transactionIncomCardFees.chart', ['months' => $months])
    @include('dashboard.transactionCardReIssuingFees.chart', ['months' => $months])
    @include('dashboard.transactionReIssuingPinFees.chart', ['months' => $months])
    @include('dashboard.transactionOBDX.chart', ['months' => $months])
    @include('dashboard.transactionOBDXCOM.chart', ['months' => $months])
    @include('dashboard.transactionIncomWU.chart', ['months' => $months])
    @include('dashboard.transactionWU.chart', ['months' => $months])
    @include('dashboard.transactionSMS.chart', ['months' => $months])
    @include('dashboard.transactionSMSCOM.chart', ['months' => $months])
    @include('dashboard.transactionATM.chart', ['months' => $months])
    @include('dashboard.transactionPOS.chart', ['months' => $months])
    

</div>
<div>

</div>
<div class="row">
    @include('dashboard.transactionMasterCardIssuingFees.chart', ['months' => $months])
    @include('dashboard.transactionMasterCardChargingFees.chart', ['months' => $months])
    @include('dashboard.transactionMasterCardMangmentFees.chart', ['months' => $months])
    @include('dashboard.transactionATMOFFUSFees.chart', ['months' => $months])
    @include('dashboard.transactionMasterATM.chart', ['months' => $months])
    @include('dashboard.transactionMarkupFees.chart', ['months' => $months])
    @include('dashboard.transactionMasterCardCoinPurchaseRequestCommission.chart', ['months' => $months])
</div>
@endsection
