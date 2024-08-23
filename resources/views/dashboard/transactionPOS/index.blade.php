
@extends('layouts.dashboard_app')
@section('title', 'Transaction POS')
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
        <a class="btn btn-success" href="{{ route('transaction_p_o_s/uplode') }}">تحميل ملف  </a>


        <br>
        <br>

        <div class="row">
          <div class="row">
            <div class="col-md-3">
                        <div class="form-group">
                        <label>الفرع</label>
                        <select type="text" name="branch_number" id="branch_number"
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
            {{-- <button type="button" class="btn btn-secondary" id="totaldebit">اجمالي الحركات   Debit: 0</button> --}}
            {{-- <button type="button" class="btn btn-success" id="totalcredit">اجمالي الحركات   Credit: 0</button> --}}

            <button type="button" class="btn btn-info" id="filteredRecords">اجمالي الحركات بعد التصفية  : 0</button>
          </div>
          <br>
            <div class="row">
              <button type="button" class="btn btn-warning mt-3" id="totalAmount">Total Amount: 0</button>
              <button type="button" class="btn btn-danger mt-3" id="netAmount">Net Amount: 0</button>
              <button type="button" class="btn btn-dark mt-3" id="amount">Amount: 0</button>
           </div>
<br>
<br>

  <div class="table-responsive">
    <table class="table table-striped" style="width: 100%" id="transaction_POS_tbl">
        <thead>
            <tr>
                <th>ID</th>
                <th>Merchant No</th>
                <th>Merchant Name</th>
                <th>Banking Account No</th>
                <th>Bank Name</th>
                <th>Branch Number</th>

                <th>Branch Name</th>
                <th>Processing Date</th>
                <th>Total Amount</th>
                <th>Net Amount</th>

                <th>Transaction No</th>
                <th>File Name</th>
            </tr>
        </thead>
        
      <tbody>

      </tbody>
      <script src="{{asset('assets/plugin/jquery.js') }}" ></script>

      <script type="text/javascript">



$(document).ready(function(){
  fill_datatable();
          function fill_datatable(branch_number='')
          {
            var table = $('#transaction_POS_tbl').DataTable({
                "initComplete": function(settings, json) {
                    var api = this.api();
                    

              // Calculate the total sum for the specified column
              var totalAmount = api.column(8).data().reduce(function(a, b) {
                  return (parseFloat(a) || 0) + (parseFloat(b) || 0);
              }, 0);
              var netAmount = api.column(9).data().reduce(function(a, b) {
                  return (parseFloat(a) || 0) + (parseFloat(b) || 0);
              }, 0);


              var percentage = 0.25; // 25% expressed as a decimal
              var total = (totalAmount - netAmount) * percentage;                 
               var totalRecords = json.recordsTotal; // This should be available in the server response
                      filteredRecords= json.recordsFiltered
                $('#total').text("الحركات:" + totalRecords); // Total records

                $('#filteredRecords').text(" الحركات  التصفية: " + filteredRecords); // Filtered records
                $('#totalAmount').text("Total Amount:" + totalAmount.toFixed(2) +"LYD");
                $('#netAmount').text("Net Amount:" + netAmount.toFixed(2) +"LYD");
                $('#amount').text("Amount:" + total.toFixed(2) +"LYD");

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
              url: "{{ route('transaction_p_o_s') }}",
              data:{branch_number:branch_number,
              }

            },

              columns: [
                
              
                   {
                      "data": "id",
                      render: function (data, type, row, meta) {

                          return meta.row + meta.settings._iDisplayStart + 1;
                      }
                  },
                    {data: 'merchant_no', name: 'merchant_no'},
                    {data: 'merchant_name', name: 'merchant_name'},
                    {data: 'banking_account_no', name: 'banking_account_no'},
                    {data: 'bank_name', name: 'bank_name'},
                    {data: 'branch_number', name: 'branch_number'},
                    {data: 'branch_name', name: 'branch_name'},
                    {data: 'processing_date', name: 'processing_date'},
                    {data: 'total_amount', name: 'total_amount'},
                    {data: 'net_amount', name: 'net_amount'},

                    {data: 'trx_no', name: 'trx_no'},
                    {data: 'file_name', name: 'file_name'},
                     




              ]
          });
          }

       
        $('#reset').click(function(){
            $('#branch_number').val('');
            $('#transaction_POS_tbl').DataTable().destroy();
        fill_datatable();
         });



      



         $('#filter').click(function(){
        var branch_number = $('#branch_number').val();




            $('#transaction_POS_tbl').DataTable().destroy();
            fill_datatable(branch_number)


    });
        });


      </script>
    </table>

  </div>


      </div>
  </div>



@endsection



