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

        foreach ($this->months as $month) {
            $monthYearString = HelperC::year . "-" . $month;
            $month_year = HelperC::convertMonthYear($monthYearString);

            $row = [
                $month,
                HelperC::get_transaction_card_issuing_fees($month_year)->total_amount ?? 0,
                HelperC::get_transaction_incom_card_fees($month_year)->total_amount ?? 0,
                HelperC::get_transaction_card_re_issuing_fees($month_year)->total_amount ?? 0,
                HelperC::get_transaction_re_issuing_pin_fees($month_year)->total_amount ?? 0,
                HelperC::get_transaction_o_b_d_x_e_s($month_year)->total_amount ?? 0,
                HelperC::get_transaction_o_b_d_x_coms($month_year)->total_amount ?? 0,
                HelperC::get_transaction_incom_w_u_s($month_year)->total_amount ?? 0,
                HelperC::get_transaction_w_u_s($month_year)->total_amount ?? 0,
                HelperC::get_transaction_s_m_s($month_year)->total_amount ?? 0,
                HelperC::get_transaction_s_m_s_c_o_m_s($month_year)->total_amount ?? 0,
                HelperC::get_transaction_a_t_m_s($month_year)->total_amount ?? 0,
                HelperC::get_transaction_p_o_s($month_year)->total_amount ?? 0,
            ];

            $data[] = $row;
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Month',
            'Card Issuing Fees',
            'Card Income Fees',
            'Card Reissuing Fees',
            'Pin Reissuing Fees',
            'OBDX Fees',
            'OBDX Company Fees',
            'Income WU Fees',
            'Outgoing WU Fees',
            'SMS Fees',
            'SMS Company Fees',
            'ATM Fees',
            'POS Fees',
        ];
    }
}
