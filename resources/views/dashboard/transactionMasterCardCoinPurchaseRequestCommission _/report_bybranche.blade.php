@extends('layouts.dashboard_app')
@section('title', 'Transaction MasterCard Coin Purchase Request Commission_ Fees Report Branche')
@section('content')

<div class="row small-spacing">
    <div class="col-lg-12 col-xs-12">
        <div class="box-content ">
            <h3 ><i class="ico glyphicon glyphicon-copyright-mark"></i> @yield('title')</h3>
           
            <!-- /.box-title -->
            
            <div class="card-content">
                
                <form  method="get" action="{{ route('transaction_master_card_coin_purchase_request_commissions_/report/branche') }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label > نوع التقرير  </label>
                        
                                <select type="text" name="report_type"
                                        class="form-control">
                                        <option label="اختر نوع التقرير"></option>
                                        <option value="pdf">PDF</option>
                                        <option value="excel">Excel</option>
                                </select>
                                @error('report_type')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> الفرع  </label>
                                <select type="text" name="branches_id"
                                        class="form-control">
                                        
                                        <option label="اختر الفرع"></option>
                                        @forelse ($branches as $branche)
                                        
                                            <option value="{{ $branche->branche_number }}" {{ old('branches_id') == $branche->id ? 'selected' : '' }}> {{ $branche->branche_name }}
                                            </option>
                                        @empty
                                            <option value="">لا يوجد فروع</option>
                                        @endforelse
                                </select>
                                @error('branches_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>
                       
                    </div>

                    <div class="col-md-3">

                        <div class="form-group" align="center">
                         <button type="submit" class="btn btn-success btn-fill pull-left"> تصدير </button>
            
                          <button type="button" name="reset" id="reset" class="btn btn-default btn-fill  pull-right">تحديث</button>
                        </div>
                      </div>
            </form>
                <div class="clearfix"></div>
    <br>
    <br>
                @if($data != null)
                @if($data->count() != 0)
        
                    <div class="table-responsive">
                      <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Month-Year</th>
                            <th>Branch</th>
                            <th>Total Credits</th>
                            <th>Total Debits</th>
                            <th>Total Amount</th>

                            <th>Total Transactions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->month_year }}</td>
                            <td>{{ $row->brn }}</td>
                            <td>{{ $row->total_credits }}</td>
                            <td>{{ $row->total_debits }}</td>
                            <td>{{ number_format($row->total_amount, 2) }}</td>

                            <td>{{ $row->total_transactions }}</td>
                        </tr>
            @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                    <td colspan="2"><strong>الاجمالي</strong></td>
             
                <td>{{ number_format($data->sum('total_credits'),2) }} دينار</td>
                <td>{{ number_format($data->sum('total_debits'),2) }} دينار</td>
                <td>{{ number_format($data->sum('total_amount'),2) }} دينار</td>

                <td>{{ $data->sum('total_transactions') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @endif
   
            @endif
            </body>
            </div>

            <!-- /.card-content -->
        </div>
        <!-- /.box-content -->
    </div>
    <!-- /.col-lg-6 col-xs-12 -->


  
  
</div>
<script src="{{asset('assets/plugin/jquery.js') }}" ></script>

<script type="text/javascript">

$(document).ready(function(){

        $('#reset').click(function(){
            $('#report_type').selectedIndex=0;
            $('#branches_id').selectedIndex=0;

            var redirectUrl = "{{ route('transaction_master_card_coin_purchase_request_commissions_/report/branche') }}";
            window.location.href = redirectUrl;
        })

})

</script>

@endsection

