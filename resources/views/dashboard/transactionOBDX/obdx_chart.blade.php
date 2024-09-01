<!-- resources/views/partials/obdx_chart.blade.php -->

<div class="col-xs-5">
    <canvas id="o_b_d_x_chart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var o_b_d_x_chart = document.getElementById('o_b_d_x_chart').getContext('2d');

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Prepare data arrays
    var labels_o_b_d_x = [];
    var data_o_b_d_x = [];
    var backgroundColors = [];
    var borderColors = [];

    @foreach ($months as $month)
        @php
            $monthYearString = \App\Classes\HelperC::year . "-" . $month;
            $month_year = \App\Classes\HelperC::convertMonthYear($monthYearString);
            $transaction_o_b_d_x_e_s = \App\Classes\HelperC::get_transaction_o_b_d_x_e_s($month_year);
            $total_amount_o_b_d_x = $transaction_o_b_d_x_e_s->total_amount ?? 0;
        @endphp
        
        labels_o_b_d_x.push("{{ $month_year }}");
        data_o_b_d_x.push("{{ $total_amount_o_b_d_x }}");

        // Generate random colors for each month
        var randomBackgroundColor = getRandomColor();
        backgroundColors.push(randomBackgroundColor);
        borderColors.push(randomBackgroundColor);
    @endforeach

    var chartData = {
        labels: labels_o_b_d_x,
        datasets: [{
            label: 'OBDX FEES',
            data: data_o_b_d_x,
            backgroundColor: backgroundColors,  // Array of random background colors
            borderColor: borderColors,          // Array of random border colors
            borderWidth: 1
        }]
    };

    var totalAmountChart = new Chart(o_b_d_x_chart, {
        type: 'bar', // or 'line', 'pie', etc.
        data: chartData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
