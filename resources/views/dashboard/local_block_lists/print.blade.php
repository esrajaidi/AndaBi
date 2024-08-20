<!doctype html>
<html dir="rtl" class="js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- CSRF Token -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>طباعة التقرير</title>
    
    <!-- Main Styles -->
    <link href="{{ asset('assets/styles/style.min.css') }}" rel="stylesheet">
    <!-- RTL -->
    <link href="{{ asset('assets/styles/style-rtl.min.css') }}" rel="stylesheet">

    <!-- Print Styles -->
    <link href="{{ asset('assets/styles/style.min.css') }}" rel="stylesheet" media="print">
    <!-- RTL -->
    <link href="{{ asset('assets/styles/style-rtl.min.css') }}" rel="stylesheet" media="print">

    <style>
        body {
            font-size: 16px; /* Base font size for readability */
            line-height: 1.6;
            margin: 20px;
            font-family: Arial, sans-serif;
        }

        h4 {
            font-size: 18px; /* Adjusted heading size */
            margin: 10px 0;
        }

        .kyc-title, .kyc-title-en {
            font-size: 18px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th, .table td {
            border: 1px solid #0067a6;
            padding: 8px;
            text-align: center;
        }

        .table thead th {
            background-color: #3ba5e3;
            color: #ffffff;
            font-size: 16px;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .box-content {
            margin: 0;
        }

        .image_up {
            height: 120px;
            margin-bottom: 10px;
        }

        .form-control[disabled] {
            background-color: #f9f9f9;
            height: auto;
        }

        @media print {
            body {
                font-size: 12px;
            }

            h4 {
                font-size: 14px;
            }

            .image_up {
                height: 80px;
                margin-bottom: 5px;
            }

            .table th, .table td {
                padding: 4px;
                font-size: 10px;
            }

            .box-content {
                margin: 0;
                padding: 5px;
            }

            .table thead th {
                font-size: 12px;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="col-xs-12">
        <div class="box-content">
            <table>
                <tr>
                    <td>
                        <hr style="margin: 0; border-top: 2px solid #e1b531;">
                    </td>
                    <td>
                        <img class="pull-left image_up" src="{{ asset('/assets/images/logo.png') }}" alt="Logo">
                    </td>
                </tr>
            </table>

            <div class="card-content">
                <table class="table">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>{{ $name }}</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr>
                            <td>Total Matches</td>
                            <td>{{ $total }}</td>
                        </tr>
                        <tr>
                            <td>آخر عرض</td>
                            <td>{{ $date }}</td>
                        </tr>
                        <tr>
                            <td>تم إنشاء الحالة</td>
                            <td>{{ $date }}</td>
                        </tr>
                        <tr>
                            <td>تصرف من قبل</td>
                            <td>{{ Auth::user()->username }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-content">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Total Matches</th>
                            <th colspan="4">{{ $total }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Positive: {{ $matched }}</td>
                            <td>False: {{ $total - $matched }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="card-content">
                <table class="table">
                    <thead>
                        <tr>
                            <th>List of Statements</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $counter = 1; @endphp
                        @if(!empty($list) && is_array($list))
                            @foreach($list as $item)
                                <tr>
                                    <td>{{ $counter }}. {{ $item }}</td>
                                </tr>
                                @php $counter++; @endphp
                            @endforeach
                        @else
                            <tr>
                                <td>No statements available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script>
  window.onafterprint = function() {
      // Redirect to the desired page after printing is complete or print dialog is closed
      window.location.href = "{{ URL::to('/local_block_lists') }}";
  };
</script>
</html>
