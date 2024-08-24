
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
                <th>Total Amount</th>
                <th>Net Amount</th>
                <th>Total Branch Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
            <tr>
                <td>{{ $row->month_year }}</td>
                <td>{{ number_format($row->total_amount_sum, 2) }}</td>
                <td>{{ number_format($row->net_amount_sum, 2) }}</td>
            <td>{{ number_format($row->total_branch_amount, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1"><strong>TOTAL</strong></td>
                <td>{{ number_format($data->sum('total_amount_sum'),2) }} LYD</td>
                <td>{{ number_format($data->sum('net_amount_sum'),2) }} LYD</td>

            <td>{{ number_format($data->sum('total_branch_amount'),2) }} LYD</td>

                    </tr>
        </tfoot>
    </table>
</body>
</html>
