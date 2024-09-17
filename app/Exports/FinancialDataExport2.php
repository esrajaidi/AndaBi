<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Classes\HelperC;

class FinancialDataExport2 implements FromArray, WithHeadings, WithStyles
{
    protected $months;

    public function __construct($months)
    {
        $this->months = $months;
    }

    public function array(): array
    {
        $data = [];
        $totals = [
            'total_transaction_w_u_s_m_s' => 0,
            'total_transaction_account_opening_commissions' => 0,
            'total_transaction_master_card_issuing_fees' => 0,
            'total_transaction_master_card_charging_fees' => 0,
            'total_transaction_master_card_mangment_fees' => 0,
            'total_transaction_a_t_m_o_f_f_u_s_fees' => 0,
            'total_transaction_master_a_t_m_s' => 0,
            'total_transaction_markumarp_fees' => 0,
            'total_transaction_master_card_coin_purchase_request_commissions' => 0,
            'total_transaction_matser_point_o_f_sale_purchase_commissions' => 0,
            'total_transaction_matser_point_o_f_sale_purchase_commission_' => 0
        ];

        foreach ($this->months as $month) {
            $monthYearString = HelperC::year . "-" . $month;
            $month_year = HelperC::convertMonthYear($monthYearString);
            $transaction_w_u_s_m_s=HelperC::get_transaction_w_u_s_m_s($month_year);

            $transaction_account_opening_commissions=HelperC::get_transaction_account_opening_commissions($month_year);
            $transaction_master_card_issuing_fees = HelperC::get_transaction_master_card_issuing_fees($month_year);
            $transaction_master_card_charging_fees = HelperC::get_transaction_master_card_charging_fees($month_year);
            $transaction_master_card_mangment_fees = HelperC::get_transaction_master_card_mangment_fees($month_year);
            $transaction_a_t_m_o_f_f_u_s_fees = HelperC::get_transaction_a_t_m_o_f_f_u_s_fees($month_year);
            $transaction_master_a_t_m_s = HelperC::get_transaction_master_a_t_m_s($month_year);
            $transaction_markumarp_fees = HelperC::get_transaction_kup_fees($month_year);
            $transaction_master_card_coin_purchase_request_commissions = HelperC::get_transaction_master_card_coin_purchase_request_commissions($month_year);
            $transaction_matser_point_o_f_sale_purchase_commissions = HelperC::get_transaction_matser_point_o_f_sale_purchase_commissions($month_year);
            $transaction_matser_point_o_f_sale_purchase_commission_ = HelperC::get_transaction_master_card_coin_purchase_request_commissions_($month_year);

            // Append row data
            $row = [
                $month,
                $transaction_w_u_s_m_s->total_amount ?? 0,

                $transaction_account_opening_commissions->total_amount ?? 0,
                $transaction_master_card_issuing_fees->total_amount ?? 0,
                $transaction_master_card_charging_fees->total_amount ?? 0,
                $transaction_master_card_mangment_fees->total_amount ?? 0,
                $transaction_a_t_m_o_f_f_u_s_fees->total_amount ?? 0,
                $transaction_master_a_t_m_s->total_amount ?? 0,
                $transaction_markumarp_fees->total_amount ?? 0,
                $transaction_master_card_coin_purchase_request_commissions->total_amount ?? 0,
                $transaction_matser_point_o_f_sale_purchase_commissions->total_amount ?? 0,
                $transaction_matser_point_o_f_sale_purchase_commission_->total_amount ?? 0,
            ];

            $data[] = $row;

            // Update totals
            $totals['total_transaction_w_u_s_m_s'] += $transaction_w_u_s_m_s->total_amount ?? 0;

            $totals['total_transaction_account_opening_commissions'] += $transaction_account_opening_commissions->total_amount ?? 0;

            $totals['total_transaction_master_card_issuing_fees'] += $transaction_master_card_issuing_fees->total_amount ?? 0;
            $totals['total_transaction_master_card_charging_fees'] += $transaction_master_card_charging_fees->total_amount ?? 0;
            $totals['total_transaction_master_card_mangment_fees'] += $transaction_master_card_mangment_fees->total_amount ?? 0;
            $totals['total_transaction_a_t_m_o_f_f_u_s_fees'] += $transaction_a_t_m_o_f_f_u_s_fees->total_amount ?? 0;
            $totals['total_transaction_master_a_t_m_s'] += $transaction_master_a_t_m_s->total_amount ?? 0;
            $totals['total_transaction_markumarp_fees'] += $transaction_markumarp_fees->total_amount ?? 0;
            $totals['total_transaction_master_card_coin_purchase_request_commissions'] += $transaction_master_card_coin_purchase_request_commissions->total_amount ?? 0;
            $totals['total_transaction_matser_point_o_f_sale_purchase_commissions'] += $transaction_matser_point_o_f_sale_purchase_commissions->total_amount ?? 0;
            $totals['total_transaction_matser_point_o_f_sale_purchase_commission_'] += $transaction_matser_point_o_f_sale_purchase_commission_->total_amount ?? 0;
        }

        // Add total row
        $data[] = [
            'Total',
            $totals['total_transaction_w_u_s_m_s'],

            $totals['total_transaction_account_opening_commissions'],

            $totals['total_transaction_master_card_issuing_fees'],
            $totals['total_transaction_master_card_charging_fees'],
            $totals['total_transaction_master_card_mangment_fees'],
            $totals['total_transaction_a_t_m_o_f_f_u_s_fees'],
            $totals['total_transaction_master_a_t_m_s'],
            $totals['total_transaction_markumarp_fees'],
            $totals['total_transaction_master_card_coin_purchase_request_commissions'],
            $totals['total_transaction_matser_point_o_f_sale_purchase_commissions'],
            $totals['total_transaction_matser_point_o_f_sale_purchase_commission_']
        ];

        return $data;
    }

    public function headings(): array
    {
        return [
            'Month',
            'عمولة ارسال رسائل ويسترن يونيون',

            'عمولة فتح حساب',
            'عمولة اصدار بطاقة ماستر كارد بلاتينيوم',
            'عمولة شحن بطاقة ماستر كارد',
            'عمولة إدارة حساب بطاقة دولية',
            'عمولة سحب من الة السحب الداتي مصارف تجارية',
            'عمولة السحب من بطاقات ماستر كارد عبر الصراف الآلي',
            'عمولة شراء بطاقات ماستر كارد عبر نقاط البيع',
            'عمولة طلب شراء عملة أغراض شخصية - ماستر كارد',
            'عمولة طلب شراء ببطاقات ماستر عبر نقاط البيعvisa',
            'عمولة طلب كشف حساب عبر الصراف ماستر كارد'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold
            1 => ['font' => ['bold' => true]],
        ];
    }
    public function columnFormats(): array
    {
        return [
            'B' => '#,##0.000', 
            'C' => '#,##0.000', 
            'D' => '#,##0.000', 
            'E' => '#,##0.000',
            'F' => '#,##0.000', 
            'G' => '#,##0.000', 
            'H' => '#,##0.000',
            'I' => '#,##0.000', 
            'J' => '#,##0.000', 
            'K' => '#,##0.000',
            'L' => '#,##0.000',
        ];
    }
}
