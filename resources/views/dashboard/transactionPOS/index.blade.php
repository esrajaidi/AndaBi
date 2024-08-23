
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
            {{-- <button type="button" class="btn btn-primary" id="total">اجمالي الحركات  : 0</button>
            <button type="button" class="btn btn-secondary" id="totaldebit">اجمالي الحركات   Debit: 0</button>
            <button type="button" class="btn btn-success" id="totalcredit">اجمالي الحركات   Credit: 0</button>

            <button type="button" class="btn btn-info" id="filteredRecords">اجمالي الحركات بعد التصفية  : 0</button>
          </div>
          <br>
            <div class="row">
            <button type="button" class="btn btn-warning" id="creditAmount">  Credit : 0</button>

            <button type="button" class="btn btn-danger" id="debitAmount">  Debit : 0</button>

            <button type="button" class="btn btn-dark" id="totalLcyAmount">  Amount : 0</button>
             
           </div> --}}
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
                <th>Net Amount</th>
                <th>Processing Date</th>
                <th>Total Amount</th>
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
          function fill_datatable(brn='')
          {
            var table = $('#transaction_POS_tbl').DataTable({
                // "initComplete": function(settings, json) {
                //     var api = this.api();

                //     // Initialize sums
                //     var totalDebits = 0;
                //     var totalCredits = 0;

                //     // Calculate the total debits and credits
                //     api.rows().data().each(function(row) {
                //         var amount = parseFloat(row['lcy_amount']); // Column 10
                //         var type = row['drcr']; // Column 6

                //         if (type === 'D') {
                //             totalDebits += amount;
                //         } else if (type === 'C') {
                //             totalCredits += amount;
                //         }
                //     });
                                            
                //     var difference = totalDebits - totalCredits;
                //     var totaldebit = table.column(6).data().filter(function(value) {
                //           return value === 'D';
                //       }).length;
                //       var totalcredit = table.column(6).data().filter(function(value) {
                //           return value === 'C';
                //       }).length;
                //     var totalRecords = json.recordsTotal; // This should be available in the server response
                //       filteredRecords= json.recordsFiltered
                // $('#total').text("الحركات:" + totalRecords); // Total records
                // $('#totaldebit').text(" الحركات Debit:" + totaldebit); // Total totaldebit
                // $('#totalcredit').text(" الحركات Credit:" + totalcredit); // Total totalcredit

                // $('#filteredRecords').text(" الحركات  التصفية: " + filteredRecords); // Filtered records
                // $('#debitAmount').text("Debit:" + totalDebits.toFixed(2) +"LYD");
                // $('#creditAmount').text("Credit:" + totalCredits.toFixed(2) +"LYD");
                // $('#totalLcyAmount').text("Amount:" + difference.toFixed(2) +"LYD");

                // },
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
                    {data: 'merchant_no', name: 'merchant_no'},
                    {data: 'merchant_name', name: 'merchant_name'},
                    {data: 'banking_account_no', name: 'banking_account_no'},
                    {data: 'bank_name', name: 'bank_name'},
                    {data: 'branch_number', name: 'branch_number'},
                    {data: 'branch_name', name: 'branch_name'},
                    {data: 'net_amount', name: 'net_amount'},
                    {data: 'processing_date', name: 'processing_date'},
                    {data: 'total_amount', name: 'total_amount'},
                    {data: 'trx_no', name: 'trx_no'},
                    {data: 'file_name', name: 'file_name'},
                     




              ]
          });
          }

       
        $('#reset').click(function(){
            $('#brn').val('');
            $('#transaction_POS_tbl').DataTable().destroy();
        fill_datatable();
         });



      



         $('#filter').click(function(){
        var brn = $('#brn').val();




            $('#transaction_POS_tbl').DataTable().destroy();
            fill_datatable(brn)


    });
        });


      </script>
    </table>

  </div>


      </div>
  </div>



@endsection



