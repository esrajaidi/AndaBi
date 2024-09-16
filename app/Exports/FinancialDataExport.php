<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Classes\HelperC;


class FinancialDataExport implements FromCollection, WithHeadings
{
    protected $months;

    public function __construct($months)
    {
        $this->months = $months;
    }

    public function collection()
    {
        $data = [];

        // Initialize totals
        $total_card_issuing_fees = 0;
        $total_incom_card_fees = 0;
        $total_card_re_issuing_fees = 0;
        $total_re_issuing_pin_fees = 0;
        $total_o_b_d_x_e_s = 0;
        $total_o_b_d_x_coms = 0;
        $total_incom_w_u_s = 0;
        $total_w_u_s = 0;
        $total_w_u_purchase_commissions=0;
        $total_s_m_s = 0;
        $total_s_m_s_c_o_m_s = 0;
        $total_a_t_m_s = 0;
        $total_p_o_s = 0;

        foreach ($this->months as $month) {
            $monthYearString = HelperC::year . "-" . $month;
            $month_year = HelperC::convertMonthYear($monthYearString);

            // Get values for each month
            $card_issuing_fees = HelperC::get_transaction_card_issuing_fees($month_year)->total_amount ?? 0;
            $incom_card_fees = HelperC::get_transaction_incom_card_fees($month_year)->total_amount ?? 0;
            $card_re_issuing_fees = HelperC::get_transaction_card_re_issuing_fees($month_year)->total_amount ?? 0;
            $re_issuing_pin_fees = HelperC::get_transaction_re_issuing_pin_fees($month_year)->total_amount ?? 0;
            $o_b_d_x_e_s = HelperC::get_transaction_o_b_d_x_e_s($month_year)->total_amount ?? 0;
            $o_b_d_x_coms = HelperC::get_transaction_o_b_d_x_coms($month_year)->total_amount ?? 0;
            $incom_w_u_s = HelperC::get_transaction_incom_w_u_s($month_year)->total_amount ?? 0;
            $w_u_s = HelperC::get_transaction_w_u_s($month_year)->total_amount ?? 0;
            $w_u_purchase_commissions = HelperC::get_transaction_w_u_purchase_commissions($month_year)->total_amount ?? 0;
            $s_m_s = HelperC::get_transaction_s_m_s($month_year)->total_amount ?? 0;
            $s_m_s_c_o_m_s = HelperC::get_transaction_s_m_s_c_o_m_s($month_year)->total_amount ?? 0;
            $a_t_m_s = HelperC::get_transaction_a_t_m_s($month_year)->total_amount ?? 0;
            $p_o_s = HelperC::get_transaction_p_o_s($month_year)->total_amount ?? 0;

            // Add to totals
            $total_card_issuing_fees += $card_issuing_fees;
            $total_incom_card_fees += $incom_card_fees;
            $total_card_re_issuing_fees += $card_re_issuing_fees;
            $total_re_issuing_pin_fees += $re_issuing_pin_fees;
            $total_o_b_d_x_e_s += $o_b_d_x_e_s;
            $total_o_b_d_x_coms += $o_b_d_x_coms;
            $total_incom_w_u_s += $incom_w_u_s;
            $total_w_u_s += $w_u_s;
            $total_w_u_purchase_commissions += $w_u_purchase_commissions;
            $total_s_m_s += $s_m_s;
            $total_s_m_s_c_o_m_s += $s_m_s_c_o_m_s;
            $total_a_t_m_s += $a_t_m_s;
            $total_p_o_s += $p_o_s;

            // Add the month's data to the collection
            $row = [
                $month,
                $card_issuing_fees,
                $incom_card_fees,
                $card_re_issuing_fees,
                $re_issuing_pin_fees,
                $o_b_d_x_e_s,
                $o_b_d_x_coms,
                $incom_w_u_s,
                $w_u_s,
                $w_u_purchase_commissions,
                $s_m_s,
                $s_m_s_c_o_m_s,
                $a_t_m_s,
                $p_o_s,
            ];

            $data[] = $row;
        }

        // Append totals row
        $data[] = [
            'Total',
            $total_card_issuing_fees,
            $total_incom_card_fees,
            $total_card_re_issuing_fees,
            $total_re_issuing_pin_fees,
            $total_o_b_d_x_e_s,
            $total_o_b_d_x_coms,
            $total_incom_w_u_s,
            $total_w_u_s,
            $total_w_u_purchase_commissions,
            $total_s_m_s,
            $total_s_m_s_c_o_m_s,
            $total_a_t_m_s,
            $total_p_o_s,
        ];

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Month',  // Keep this in English if needed
            'عمولة إصدار بطاقة سحب داتي',
            'ايرادات بطاقات الدفع المسبق',
            'اعادة إصدار بطاقة بدل فاقد',
            'إعادة اصدار رقم سري (PIN)',
            'اشتراك في خدمة الانترنت موبايل -افراد',
            'اشتراك في خدمة الانترنت موبايل -شركات',
            'عمولة حوالات ويستر يونيون صادرة',
            'عمولة على الحوالاات الخارجية الواردة',
            'عمولة شراء ويسترن يونيون',
            'عمولة اشتراك في خدمة SMS أفراد',
            'عمولة اشتراك في خدمة SMS شركات',
            'عمولة سحب من الة السحب الداتي',
            'عمولات نقاط البيع',
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
            'M' => '#,##0.000', 
            'N' => '#,##0.000', 
        ];
    }
}
