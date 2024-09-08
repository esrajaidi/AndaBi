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
                        <th>عمولة إصدار بطاقة سحب داتي</th>
                        <th>ايرادات بطاقات الدفع المسبق</th>
                        <th>اعادة إصدار بطاقة بدل فاقد</th>
                        <th>إعادة اصدار رقم سري (PIN)</th>
                        <th>اشتراك في خدمة الانترنت موبايل -افراد</th>
                        <th>اشتراك في خدمة الانترنت موبايل -شركات </th>
                        <th> عمولة حوالات ويستر يونيون صادرة</th>
                        <th> عمولة على الحوالاات الخارجية الواردة</th>
                        <th>عمولة اشتراك في خدمة sms أفراد</th>
                        <th> عمولة اشتراك في خدمة sms شركات</th>
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
                    <th>Master Card Issuing Fees</th>
                    <th>Master Card Charging Fees</th>
                    <th>Master Card Mangment Fees</th>
                    <th>ATM OFF US Fees</th>
                    <th>Master ATM</th>
                    <th>عمولة شراء بطاقات ماستر كارد عبر نقاط البيع </th>
                    <th>Master Card Coin Commission</th>
                    <th>Matser PointOF Sale Commission</th>
                    <th>Matser PointOF Sale Commission_55</th>


                </tr>
            </thead>
            <tbody>
                @php
                    $total_transaction_master_card_issuing_fees = 0;
                    $total_transaction_master_card_charging_fees = 0;
                    $total_transaction_master_card_mangment_fees = 0;
                    $total_transaction_a_t_m_o_f_f_u_s_fees = 0;
                    $total_transaction_master_a_t_m_s = 0;
                    $total_transaction_markumarp_fees = 0;
                    $total_transaction_master_card_coin_purchase_request_commissions = 0;
                    $total_transaction_matser_point_o_f_sale_purchase_commissions = 0;
                    $total_transaction_matser_point_o_f_sale_purchase_commission_ = 0;

                    
                @endphp
                @foreach ($months as $month)
                    @php
                        $monthYearString = \App\Classes\HelperC::year . "-" . $month;
                        $month_year = \App\Classes\HelperC::convertMonthYear($monthYearString);
                        
                        $transaction_master_card_issuing_fees = \App\Classes\HelperC::get_transaction_master_card_issuing_fees($month_year);
                        $transaction_master_card_charging_fees = \App\Classes\HelperC::get_transaction_master_card_charging_fees($month_year);
                        $transaction_master_card_mangment_fees = \App\Classes\HelperC::get_transaction_master_card_mangment_fees($month_year);
                        $transaction_a_t_m_o_f_f_u_s_fees = \App\Classes\HelperC::get_transaction_a_t_m_o_f_f_u_s_fees($month_year);
                        $transaction_master_a_t_m_s = \App\Classes\HelperC::get_transaction_master_a_t_m_s($month_year);
                        $transaction_markumarp_fees = \App\Classes\HelperC::get_transaction_kup_fees($month_year);
                        $transaction_master_card_coin_purchase_request_commissions = \App\Classes\HelperC::get_transaction_master_card_coin_purchase_request_commissions($month_year);
                        $transaction_matser_point_o_f_sale_purchase_commissions = \App\Classes\HelperC::get_transaction_matser_point_o_f_sale_purchase_commissions($month_year);
                        $transaction_matser_point_o_f_sale_purchase_commission_ = \App\Classes\HelperC::get_transaction_master_card_coin_purchase_request_commissions_($month_year);


                        $total_transaction_master_card_issuing_fees += $transaction_master_card_issuing_fees->total_amount ?? 0;
                        $total_transaction_master_card_charging_fees += $transaction_master_card_charging_fees->total_amount ?? 0;
                        $total_transaction_master_card_mangment_fees += $transaction_master_card_mangment_fees->total_amount ?? 0;
                        $total_transaction_a_t_m_o_f_f_u_s_fees += $transaction_a_t_m_o_f_f_u_s_fees->total_amount ?? 0;
                        $total_transaction_master_a_t_m_s += $transaction_master_a_t_m_s->total_amount ?? 0;
                        $total_transaction_markumarp_fees += $transaction_markumarp_fees->total_amount ?? 0;
                        $total_transaction_master_card_coin_purchase_request_commissions += $transaction_master_card_coin_purchase_request_commissions->total_amount ?? 0;
                        
                        $total_transaction_matser_point_o_f_sale_purchase_commissions += $transaction_matser_point_o_f_sale_purchase_commissions->total_amount ?? 0;
                        $total_transaction_matser_point_o_f_sale_purchase_commission_ += $transaction_matser_point_o_f_sale_purchase_commission_->total_amount ?? 0;

                    @endphp
                    <tr>
                        <td>{{ $month }}</td>
                        <td>{{ $transaction_master_card_issuing_fees->total_amount ?? 0 }}</td>
                        <td>{{ $transaction_master_card_charging_fees->total_amount ?? 0 }}</td>
                        <td>{{ $transaction_master_card_mangment_fees->total_amount ?? 0 }}</td>
                        <td>{{ $transaction_a_t_m_o_f_f_u_s_fees->total_amount ?? 0 }}</td>
                        <td>{{ $transaction_master_a_t_m_s->total_amount ?? 0 }}</td>
                        <td>{{ $transaction_markumarp_fees->total_amount ?? 0 }}</td>
                        <td>{{ $transaction_master_card_coin_purchase_request_commissions->total_amount ?? 0 }}</td>
                        <td>{{ $transaction_matser_point_o_f_sale_purchase_commissions->total_amount ?? 0 }}</td>
                        <td>{{ $transaction_matser_point_o_f_sale_purchase_commission_->total_amount ?? 0 }}</td>

                    </tr>
                @endforeach
            </tbody>
            <tfoot>
            <tr>
                <th>Total</th>
                <th>{{ $total_transaction_master_card_issuing_fees }}</th>
                <th>{{ $total_transaction_master_card_charging_fees }}</th>
                <th>{{ $total_transaction_master_card_mangment_fees }}</th>
                <th>{{ $total_transaction_a_t_m_o_f_f_u_s_fees }}</th>
                <th>{{ $total_transaction_master_a_t_m_s }}</th>
                <th>{{ $total_transaction_markumarp_fees }}</th>
                <th>{{ $total_transaction_master_card_coin_purchase_request_commissions }}</th>
                <th>{{ $total_transaction_matser_point_o_f_sale_purchase_commissions }}</th>
                <th>{{ $total_transaction_matser_point_o_f_sale_purchase_commission_ }}</th>

            </tr>
        </tfoot>
        </table>
    </div>
</div>
<div class="row">
    @include('dashboard.transactionMasterCardIssuingFees.chart', ['months' => $months])
    @include('dashboard.transactionMasterCardChargingFees.chart', ['months' => $months])
    @include('dashboard.transactionMasterCardMangmentFees.chart', ['months' => $months])
    @include('dashboard.transactionATMOFFUSFees.chart', ['months' => $months])
    @include('dashboard.transactionMasterATM.chart', ['months' => $months])
    @include('dashboard.transactionMarkupFees.chart', ['months' => $months])
    @include('dashboard.transactionMasterCardCoinPurchaseRequestCommission.chart', ['months' => $months])
    @include('dashboard.transactionMatserPointOFSalePurchaseCommission.chart', ['months' => $months])
    @include('dashboard.transactionMasterCardCoinPurchaseRequestCommission_.chart', ['months' => $months])

</div>
@endsection
