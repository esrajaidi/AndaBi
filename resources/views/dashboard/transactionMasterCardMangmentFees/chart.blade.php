<!-- resources/views/partials/obdx_chart.blade.php -->

<div class="col-xs-5">
    <canvas id="master_card_mangment_fees_chart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var master_card_mangment_fees_chart = document.getElementById('master_card_mangment_fees_chart').getContext('2d');

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    // Prepare data arrays
    var labels = [];
    var data = [];
    var backgroundColors = [];
    var borderColors = [];

    @foreach ($months as $month)
        @php
            $monthYearString = \App\Classes\HelperC::year . "-" . $month;
            $month_year = \App\Classes\HelperC::convertMonthYear($monthYearString);
            $transaction = \App\Classes\HelperC::get_transaction_master_card_mangment_fees($month_year);
            $total_amount = $transaction->total_amount ?? 0;
        @endphp
        
        labels.push("{{ $month_year }}");
        data.push("{{ $total_amount }}");

        // Generate random colors for each month
        var randomBackgroundColor = getRandomColor();
        backgroundColors.push(randomBackgroundColor);
        borderColors.push(randomBackgroundColor);
    @endforeach

    var chartData = {
        labels: labels,
        datasets: [{
            label: 'عمولة إدارة حساب بطاقة دولية',
            data: data,
            backgroundColor: backgroundColors,  // Array of random background colors
            borderColor: borderColors,          // Array of random border colors
            borderWidth: 1
        }]
    };

    var totalAmountChart = new Chart(master_card_mangment_fees_chart, {
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
