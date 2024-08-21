<!-- resources/views/reports/transactions_pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>{{$title}}</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>{{$title}}</h1>
    <table>
        <thead>
            <tr>
                <th>Month-Year</th>
                <th>Branch</th>
                <th>Total Amount</th>
                <th>Total Transactions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    <td>{{ $row->month_year }}</td>
                    <td>{{ $row->brn }}</td>
                    <td>{{ number_format($row->total_amount, 2) }}</td>
                    <td>{{ $row->total_transactions }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2"><strong>Total</strong></td>
 
                <td>{{ number_format($data->sum('total_amount'),2) }} LYD</td>
                <td>{{ $data->sum('total_transactions') }}</td>
                        </tr>
        </tfoot>
    </table>
</body>
</html>
