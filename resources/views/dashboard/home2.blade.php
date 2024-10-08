@extends('layouts.dashboard_app')
@section('title', 'الرئسية')

@section('content')
<div class="row small-spacing">
    <div class="col-xs-12">
        <div class="container my-5">
            <h2 class="text-center">Financial Data Quarter</h2>
            {{-- <a href="{{ route('/export-quarterly-fees') }}" class="btn btn-success">Export to Excel</a> --}}
            <br><br>

            @php
                $quarters = [
                    'Q1' => ['January', 'February', 'March'],
                    'Q2' => ['April', 'May', 'June'],
                    'Q3' => ['July', 'August', 'September'],
                    'Q4' => ['October', 'November', 'December']
                ];

                // Initialize an array to store quarterly totals for each fee type
                $quarter_totals = [
                    'Q1' => [
                        'card_issuing_fees' => 0, 'incom_card_fees' => 0, 'card_re_issuing_fees' => 0,
                        're_issuing_pin_fees' => 0, 'o_b_d_x_e_s' => 0, 'o_b_d_x_coms' => 0,
                        'incom_w_u_s' => 0, 'w_u_s' => 0, 'w_u_purchase_commissions' => 0, 's_m_s' => 0, 's_m_s_c_o_m_s' => 0,
                        'a_t_m_s' => 0, 'p_o_s' => 0
                    ],
                    'Q2' => [
                        'card_issuing_fees' => 0, 'incom_card_fees' => 0, 'card_re_issuing_fees' => 0,
                        're_issuing_pin_fees' => 0, 'o_b_d_x_e_s' => 0, 'o_b_d_x_coms' => 0,
                        'incom_w_u_s' => 0, 'w_u_s' => 0,'w_u_purchase_commissions' => 0, 's_m_s' => 0, 's_m_s_c_o_m_s' => 0,
                        'a_t_m_s' => 0, 'p_o_s' => 0
                    ],
                    'Q3' => [
                        'card_issuing_fees' => 0, 'incom_card_fees' => 0, 'card_re_issuing_fees' => 0,
                        're_issuing_pin_fees' => 0, 'o_b_d_x_e_s' => 0, 'o_b_d_x_coms' => 0,
                        'incom_w_u_s' => 0, 'w_u_s' => 0,'w_u_purchase_commissions' => 0, 's_m_s' => 0, 's_m_s_c_o_m_s' => 0,
                        'a_t_m_s' => 0, 'p_o_s' => 0
                    ],
                    'Q4' => [
                        'card_issuing_fees' => 0, 'incom_card_fees' => 0, 'card_re_issuing_fees' => 0,
                        're_issuing_pin_fees' => 0, 'o_b_d_x_e_s' => 0, 'o_b_d_x_coms' => 0,
                        'incom_w_u_s' => 0, 'w_u_s' => 0,'w_u_purchase_commissions' => 0, 's_m_s' => 0, 's_m_s_c_o_m_s' => 0,
                        'a_t_m_s' => 0, 'p_o_s' => 0
                    ]
                ];

                // Initialize an array to store the total sum for each fee type across all quarters
                $total_totals = [
                    'card_issuing_fees' => 0, 'incom_card_fees' => 0, 'card_re_issuing_fees' => 0,
                    're_issuing_pin_fees' => 0, 'o_b_d_x_e_s' => 0, 'o_b_d_x_coms' => 0,
                    'incom_w_u_s' => 0, 'w_u_s' => 0, 'w_u_purchase_commissions' => 0,'s_m_s' => 0, 's_m_s_c_o_m_s' => 0,
                    'a_t_m_s' => 0, 'p_o_s' => 0
                ];
            @endphp
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>Quarter</th>
                        <th>عمولة إصدار بطاقة سحب داتي</th>
                        <th>ايرادات بطاقات الدفع المسبق</th>
                        <th>اعادة إصدار بطاقة بدل فاقد</th>
                        <th>إعادة اصدار رقم سري (PIN)</th>
                        <th>اشتراك في خدمة الانترنت موبايل -افراد</th>
                        <th>اشتراك في خدمة الانترنت موبايل -شركات </th>
                        <th> عمولة حوالات ويستر يونيون صادرة</th>
                        <th> عمولة على الحوالاات الخارجية الواردة</th>
                        <th> عمولة شراء ويسترن يونيون</th>

                        <th>عمولة اشتراك في خدمة sms أفراد</th>
                        <th> عمولة اشتراك في خدمة sms شركات</th>
                        <th> عمولة سحب من الة السحب الداتي</th>
                        <th>عمولات نقاط البيع </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($quarters as $quarter => $monthsInQuarter)
                        @foreach ($monthsInQuarter as $month)
                            @php
                                $monthYearString = \App\Classes\HelperC::year . "-" . $month;
                                $month_year = \App\Classes\HelperC::convertMonthYear($monthYearString);
                                
                                // Fetch transaction data for the current month
                                $transaction_card_issuing_fees = \App\Classes\HelperC::get_transaction_card_issuing_fees($month_year);
                                $transaction_incom_card_fees = \App\Classes\HelperC::get_transaction_incom_card_fees($month_year);
                                $transaction_card_re_issuing_fees = \App\Classes\HelperC::get_transaction_card_re_issuing_fees($month_year);
                                $transaction_re_issuing_pin_fees = \App\Classes\HelperC::get_transaction_re_issuing_pin_fees($month_year);
                                $transaction_o_b_d_x_e_s = \App\Classes\HelperC::get_transaction_o_b_d_x_e_s($month_year);
                                $transaction_o_b_d_x_coms = \App\Classes\HelperC::get_transaction_o_b_d_x_coms($month_year);
                                $transaction_incom_w_u_s = \App\Classes\HelperC::get_transaction_incom_w_u_s($month_year);
                                $transaction_w_u_s = \App\Classes\HelperC::get_transaction_w_u_s($month_year);
                                $transaction_w_u_purchase_commissions = \App\Classes\HelperC::get_transaction_w_u_purchase_commissions($month_year);

                                $transaction_s_m_s = \App\Classes\HelperC::get_transaction_s_m_s($month_year);
                                $transaction_s_m_s_c_o_m_s = \App\Classes\HelperC::get_transaction_s_m_s_c_o_m_s($month_year);
                                $transaction_a_t_m_s = \App\Classes\HelperC::get_transaction_a_t_m_s($month_year);
                                $transaction_p_o_s = \App\Classes\HelperC::get_transaction_p_o_s($month_year);
        
                                // Accumulate quarterly totals
                                $quarter_totals[$quarter]['card_issuing_fees'] += $transaction_card_issuing_fees->total_amount ?? 0;
                                $quarter_totals[$quarter]['incom_card_fees'] += $transaction_incom_card_fees->total_amount ?? 0;
                                $quarter_totals[$quarter]['card_re_issuing_fees'] += $transaction_card_re_issuing_fees->total_amount ?? 0;
                                $quarter_totals[$quarter]['re_issuing_pin_fees'] += $transaction_re_issuing_pin_fees->total_amount ?? 0;
                                $quarter_totals[$quarter]['o_b_d_x_e_s'] += $transaction_o_b_d_x_e_s->total_amount ?? 0;
                                $quarter_totals[$quarter]['o_b_d_x_coms'] += $transaction_o_b_d_x_coms->total_amount ?? 0;
                                $quarter_totals[$quarter]['incom_w_u_s'] += $transaction_incom_w_u_s->total_amount ?? 0;
                                $quarter_totals[$quarter]['w_u_s'] += $transaction_w_u_s->total_amount ?? 0;
                                $quarter_totals[$quarter]['w_u_purchase_commissions'] += $transaction_w_u_purchase_commissions->total_amount ?? 0;
                                $quarter_totals[$quarter]['s_m_s'] += $transaction_s_m_s->total_amount ?? 0;
                                $quarter_totals[$quarter]['s_m_s_c_o_m_s'] += $transaction_s_m_s_c_o_m_s->total_amount ?? 0;
                                $quarter_totals[$quarter]['a_t_m_s'] += $transaction_a_t_m_s->total_amount ?? 0;
                                $quarter_totals[$quarter]['p_o_s'] += $transaction_p_o_s->total_amount ?? 0;
                                
                                // Add to the total_totals array
                                $total_totals['card_issuing_fees'] += $transaction_card_issuing_fees->total_amount ?? 0;
                                $total_totals['incom_card_fees'] += $transaction_incom_card_fees->total_amount ?? 0;
                                $total_totals['card_re_issuing_fees'] += $transaction_card_re_issuing_fees->total_amount ?? 0;
                                $total_totals['re_issuing_pin_fees'] += $transaction_re_issuing_pin_fees->total_amount ?? 0;
                                $total_totals['o_b_d_x_e_s'] += $transaction_o_b_d_x_e_s->total_amount ?? 0;
                                $total_totals['o_b_d_x_coms'] += $transaction_o_b_d_x_coms->total_amount ?? 0;
                                $total_totals['incom_w_u_s'] += $transaction_incom_w_u_s->total_amount ?? 0;
                                $total_totals['w_u_s'] += $transaction_w_u_s->total_amount ?? 0;
                                $total_totals['w_u_purchase_commissions'] += $transaction_w_u_purchase_commissions->total_amount ?? 0;
                                $total_totals['s_m_s'] += $transaction_s_m_s->total_amount ?? 0;
                                $total_totals['s_m_s_c_o_m_s'] += $transaction_s_m_s_c_o_m_s->total_amount ?? 0;
                                $total_totals['a_t_m_s'] += $transaction_a_t_m_s->total_amount ?? 0;
                                $total_totals['p_o_s'] += $transaction_p_o_s->total_amount ?? 0;
                            @endphp
                        @endforeach

                        <tr>
                            <td>{{ $quarter }}</td>
                            <td>{{ $quarter_totals[$quarter]['card_issuing_fees'] }}</td>
                            <td>{{ $quarter_totals[$quarter]['incom_card_fees'] }}</td>
                            <td>{{ $quarter_totals[$quarter]['card_re_issuing_fees'] }}</td>
                            <td>{{ $quarter_totals[$quarter]['re_issuing_pin_fees'] }}</td>
                            <td>{{ $quarter_totals[$quarter]['o_b_d_x_e_s'] }}</td>
                            <td>{{ $quarter_totals[$quarter]['o_b_d_x_coms'] }}</td>
                            <td>{{ $quarter_totals[$quarter]['incom_w_u_s'] }}</td>
                            <td>{{ $quarter_totals[$quarter]['w_u_s'] }}</td>
                            <td>{{ $quarter_totals[$quarter]['w_u_purchase_commissions'] }}</td>
                            <td>{{ $quarter_totals[$quarter]['s_m_s'] }}</td>
                            <td>{{ $quarter_totals[$quarter]['s_m_s_c_o_m_s'] }}</td>
                            <td>{{ $quarter_totals[$quarter]['a_t_m_s'] }}</td>
                            <td>{{ $quarter_totals[$quarter]['p_o_s'] }}</td>
                        </tr>
                    @endforeach
                </tbody>

                <!-- Add a footer row for the total sums -->
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th>{{ $total_totals['card_issuing_fees'] }}</th>
                        <th>{{ $total_totals['incom_card_fees'] }}</th>
                        <th>{{ $total_totals['card_re_issuing_fees'] }}</th>
                        <th>{{ $total_totals['re_issuing_pin_fees'] }}</th>
                        <th>{{ $total_totals['o_b_d_x_e_s'] }}</th>
                        <th>{{ $total_totals['o_b_d_x_coms'] }}</th>
                        <th>{{ $total_totals['incom_w_u_s'] }}</th>
                        <th>{{ $total_totals['w_u_s'] }}</th>
                        <th>{{ $total_totals['w_u_purchase_commissions'] }}</th>
                        <th>{{ $total_totals['s_m_s'] }}</th>
                        <th>{{ $total_totals['s_m_s_c_o_m_s'] }}</th>
                        <th>{{ $total_totals['a_t_m_s'] }}</th>
                        <th>{{ $total_totals['p_o_s'] }}</th>
                    </tr>
                </tfoot>
            </table>

<br>


@php
    $grand_totals = [
        'w_u_s_m_s'=>0,
        'account_opening_commissions'=>0,
        'master_card_issuing_fees' => 0,
        'master_card_charging_fees' => 0,
        'master_card_mangment_fees' => 0,
        'a_t_m_o_f_f_u_s_fees' => 0,
        'master_a_t_m_s' => 0,
        'markumarp_fees' => 0,
        'master_card_coin_purchase_request_commissions' => 0,
        'matser_point_o_f_sale_purchase_commissions' => 0,
        'matser_point_o_f_sale_purchase_commission_' => 0
    ];
@endphp

<table class="table table-bordered table-striped table-hover">
    <thead class="thead-dark">
        <tr>
            <th>Quarter</th>
            <th>عمولة ارسال رسائل ويسترن يونيون </th>

            <th>عمولة فتح حساب </th>

            <th>عمولة اصدار بطاقة ماستر كارد بلاتينيوم</th>
                    <th>عمولة شحن بطاقة ماستر كارد </th>
                    <th>عمولة إدارة حساب بطاقة دولية</th>
                    <th>عمولة سحب من الة السحب الداتي مصارف تجارية</th>
                    <th>عمولة السحب من بطاقات ماستر كارد عبر الصراف الآلي</th>
                    <th>عمولة شراء بطاقات ماستر كارد عبر نقاط البيع </th>
                    <th>عمولة طلب شراء عملة أغراض شخصية - ماستر كارد</th>
                    <th>عمولة طلب شراء ببطاقات ماستر عبر نقاط البيعvisa</th>
                    <th> عمولة طلب كشف حساب عبر الصراف ماستر كارد</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($quarters as $quarter => $months)
            @php
                $quarter_totals = [
                    'w_u_s_m_s' =>0,
                    'account_opening_commissions' =>0,
                    'master_card_issuing_fees' => 0,
                    'master_card_charging_fees' => 0,
                    'master_card_mangment_fees' => 0,
                    'a_t_m_o_f_f_u_s_fees' => 0,
                    'master_a_t_m_s' => 0,
                    'markumarp_fees' => 0,
                    'master_card_coin_purchase_request_commissions' => 0,
                    'matser_point_o_f_sale_purchase_commissions' => 0,
                    'matser_point_o_f_sale_purchase_commission_' => 0
                ];

                foreach ($months as $month) {
                    $monthYearString = \App\Classes\HelperC::year . "-" . $month;
                    $month_year = \App\Classes\HelperC::convertMonthYear($monthYearString);

                    // Fetch transaction data for the month
                    $transaction_w_u_s_m_s= \App\Classes\HelperC::get_transaction_w_u_s_m_s($month_year);
                    $transaction_account_opening_commissions= \App\Classes\HelperC::get_transaction_account_opening_commissions($month_year);
                    $transaction_master_card_issuing_fees = \App\Classes\HelperC::get_transaction_master_card_issuing_fees($month_year);
                    $transaction_master_card_charging_fees = \App\Classes\HelperC::get_transaction_master_card_charging_fees($month_year);
                    $transaction_master_card_mangment_fees = \App\Classes\HelperC::get_transaction_master_card_mangment_fees($month_year);
                    $transaction_a_t_m_o_f_f_u_s_fees = \App\Classes\HelperC::get_transaction_a_t_m_o_f_f_u_s_fees($month_year);
                    $transaction_master_a_t_m_s = \App\Classes\HelperC::get_transaction_master_a_t_m_s($month_year);
                    $transaction_markumarp_fees = \App\Classes\HelperC::get_transaction_kup_fees($month_year);
                    $transaction_master_card_coin_purchase_request_commissions = \App\Classes\HelperC::get_transaction_master_card_coin_purchase_request_commissions($month_year);
                    $transaction_matser_point_o_f_sale_purchase_commissions = \App\Classes\HelperC::get_transaction_matser_point_o_f_sale_purchase_commissions($month_year);
                    $transaction_matser_point_o_f_sale_purchase_commission_ = \App\Classes\HelperC::get_transaction_master_card_coin_purchase_request_commissions_($month_year);

                    // Sum up the totals for the quarter
                    $quarter_totals['w_u_s_m_s'] += $transaction_w_u_s_m_s->total_amount ?? 0;

                    $quarter_totals['account_opening_commissions'] += $transaction_account_opening_commissions->total_amount ?? 0;
                    $quarter_totals['master_card_issuing_fees'] += $transaction_master_card_issuing_fees->total_amount ?? 0;
                    $quarter_totals['master_card_charging_fees'] += $transaction_master_card_charging_fees->total_amount ?? 0;
                    $quarter_totals['master_card_mangment_fees'] += $transaction_master_card_mangment_fees->total_amount ?? 0;
                    $quarter_totals['a_t_m_o_f_f_u_s_fees'] += $transaction_a_t_m_o_f_f_u_s_fees->total_amount ?? 0;
                    $quarter_totals['master_a_t_m_s'] += $transaction_master_a_t_m_s->total_amount ?? 0;
                    $quarter_totals['markumarp_fees'] += $transaction_markumarp_fees->total_amount ?? 0;
                    $quarter_totals['master_card_coin_purchase_request_commissions'] += $transaction_master_card_coin_purchase_request_commissions->total_amount ?? 0;
                    $quarter_totals['matser_point_o_f_sale_purchase_commissions'] += $transaction_matser_point_o_f_sale_purchase_commissions->total_amount ?? 0;
                    $quarter_totals['matser_point_o_f_sale_purchase_commission_'] += $transaction_matser_point_o_f_sale_purchase_commission_->total_amount ?? 0;
                }

                // Add the quarter totals to the grand totals
                foreach ($quarter_totals as $key => $total) {
                    $grand_totals[$key] += $total;
                }
            @endphp

            <tr>
                <td>{{ $quarter }}</td>
                <td>{{ $quarter_totals['w_u_s_m_s'] }}</td>
                <td>{{ $quarter_totals['account_opening_commissions'] }}</td>
                <td>{{ $quarter_totals['master_card_issuing_fees'] }}</td>
                <td>{{ $quarter_totals['master_card_charging_fees'] }}</td>
                <td>{{ $quarter_totals['master_card_mangment_fees'] }}</td>
                <td>{{ $quarter_totals['a_t_m_o_f_f_u_s_fees'] }}</td>
                <td>{{ $quarter_totals['master_a_t_m_s'] }}</td>
                <td>{{ $quarter_totals['markumarp_fees'] }}</td>
                <td>{{ $quarter_totals['master_card_coin_purchase_request_commissions'] }}</td>
                <td>{{ $quarter_totals['matser_point_o_f_sale_purchase_commissions'] }}</td>
                <td>{{ $quarter_totals['matser_point_o_f_sale_purchase_commission_'] }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            <td>{{ $grand_totals['w_u_s_m_s'] }}</td>

            <td>{{ $grand_totals['account_opening_commissions'] }}</td>
            <th>{{ $grand_totals['master_card_issuing_fees'] }}</th>
            <th>{{ $grand_totals['master_card_charging_fees'] }}</th>
            <th>{{ $grand_totals['master_card_mangment_fees'] }}</th>
            <th>{{ $grand_totals['a_t_m_o_f_f_u_s_fees'] }}</th>
            <th>{{ $grand_totals['master_a_t_m_s'] }}</th>
            <th>{{ $grand_totals['markumarp_fees'] }}</th>
            <th>{{ $grand_totals['master_card_coin_purchase_request_commissions'] }}</th>
            <th>{{ $grand_totals['matser_point_o_f_sale_purchase_commissions'] }}</th>
            <th>{{ $grand_totals['matser_point_o_f_sale_purchase_commission_'] }}</th>
        </tr>
    </tfoot>
</table>

@endsection
