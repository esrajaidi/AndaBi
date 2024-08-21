
@extends('layouts.dashboard_app')
@section('title', 'Transaction OBDX')
@section('content')
<style>
  .btn-export {
    background: green !important;
    border: none !important;
    color: #fff !important;
    font-size: 16px !important;
    line-height: 26px !important;
    padding: 8px 25px!important;
    font-weight: 500   !important;
  }
  </style>
<div class="row small-spacing">
    <div class="col-xs-12">
      <div class="box-content">
        <h3 ><i class="ico fa fa-list-ul"></i> @yield('title')</h3>
        <br>
        <a class="btn btn-success" href="{{ route('transaction_o_b_d_x_e_s/uplode') }}">تحميل ملف  </a>


        <br>
        <br>

        <div class="row">
          <div class="row">
            <div class="col-md-3">
                        <div class="form-group">
                        <label>الفرع</label>
                        <select type="text" name="brn" id="brn"
                                                class="form-control">
                                                <option label="اختر فرع "></option>
                                                @forelse ($branches as $branche)
                                                <option value="{{ $branche->branche_number }}">
                                            
                                                    {{  $branche->branche_name }}
    

                                                </option>
                                                @empty
                                                    <option value="">لا يوجد فروع</option>
                                                @endforelse
                                        </select>

                        </div>
                    </div>
         
             

          </div>
          <div class="row">
            <div class="form-group" align="center">
              <button type="button" name="filter" id="filter" class="btn btn-info">بحث</button>

              <button type="button" name="reset" id="reset" class="btn btn-default">تحديث</button>
            
          </div>
          </div>

        </div>
        <div class="row">
            <button type="button" class="btn btn-primary" id="total">اجمالي الحركات  : 0</button>
            <button type="button" class="btn btn-info" id="totalAmount">اجمالي العمولة : 0</button>
            <button type="button" class="btn btn-warning" id="totalLcyAmount"> LCY Amount : 0</button>

           </div>
<br>
<br>

  <div class="table-responsive">
    <table class="table table-striped" style="width: 100%" id="transaction_OBDX_tbl">
        <thead>
            <tr>
                <th>ID</th>
                <th>Transaction Reference Number</th>
                <th>Event</th>
                <th>Branch</th>
                <th>Account Number</th>
                <th>Currency</th>
                <th>Debit/Credit</th>
                <th>Transaction Code</th>
                <th>Foreign Currency Amount</th>
                <th>Exchange Rate</th>
                <th>Local Currency Amount</th>
                <th>Transaction Date</th>
                <th>Value Date</th>
                <th>Related Account</th>
                <th>Maker</th>
                <th>Checker</th>
                <th>Entry Serial Number</th>
            </tr>
        </thead>
        
      <tbody>

      </tbody>
      <script src="{{asset('assets/plugin/jquery.js') }}" ></script>

      <script type="text/javascript">



$(document).ready(function(){
  fill_datatable();
          function fill_datatable(brn='')
          {
            var table = $('#transaction_OBDX_tbl').DataTable({
                "initComplete": function(settings, json) {
                    var api = this.api();
                    var totalLcyAmount = api
                        .column(10, { search: 'applied' }) // 
                        .data()
                        .reduce(function(a, b) {
                            return parseFloat(a) + parseFloat(b);
                        }, 0);

                    var totalRecords = json.recordsTotal; // This should be available in the server response
                    filteredRecords= json.recordsFiltered
                // Update the HTML elements with the counts
                $('#total').text("اجمالي الحركات : " + totalRecords); // Total records
                $('#totalAmount').text("عدد الحركات بعد التصفية : " + filteredRecords); // Filtered records
                $('#totalLcyAmount').text(" LCY Amount: " + totalLcyAmount.toFixed(2) +"دينار");

                },
            processing: true,
            serverSide: false,
            searching: false,
            dom: "Blfrtip",
        buttons: [
                  {
                    extend: 'excel',
                    text: 'تصدير اكسل',
                    className: 'btn-export'
                },
  
                ],
            ajax: {
              url: "{{ route('transaction_o_b_d_x_e_s') }}",
              data:{brn:brn,
              }

            },

              columns: [
                
              
                   {
                      "data": "id",
                      render: function (data, type, row, meta) {

                          return meta.row + meta.settings._iDisplayStart + 1;
                      }
                  },
                    {data: 'trn_ref_no', name: 'trn_ref_no'},
                    {data: 'event', name: 'event'},
                    {data: 'brn', name: 'brn'},
                    {data: 'ac_no', name: 'ac_no'},
                    {data: 'ccy', name: 'ccy'},
                    {data: 'drcr', name: 'drcr'},
                    {data: 'trn_code', name: 'trn_code'},
                    {data: 'fcy_amount', name: 'fcy_amount'},
                    {data: 'exch_rate', name: 'exch_rate'},
                    {data: 'lcy_amount', name: 'lcy_amount'},
                    {data: 'trn_date', name: 'trn_date'},
                    {data: 'value_date', name: 'value_date'},
                    {data: 'related_account', name: 'related_account'},
                    {data: 'maker', name: 'maker'},
                    {data: 'checker', name: 'checker'},
                    {data: 'entry_sr_no', name: 'entry_sr_no'},




              ]
          });
          }

       
        $('#reset').click(function(){
            $('#brn').val('');
            $('#transaction_OBDX_tbl').DataTable().destroy();
        fill_datatable();
         });



      



         $('#filter').click(function(){
        var brn = $('#brn').val();




            $('#transaction_OBDX_tbl').DataTable().destroy();
            fill_datatable(brn)


    });
        });


      </script>
    </table>

  </div>


      </div>
  </div>



@endsection



