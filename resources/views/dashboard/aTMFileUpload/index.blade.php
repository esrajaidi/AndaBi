
@extends('layouts.dashboard_app')
@section('title', 'Transaction ATM File Upload')
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
        <h3 ><i class="ico fa fa-reorder"></i> @yield('title')</h3>
        <br>
        <a class="btn btn-success" href="{{ route('a_t_m_file_uploads/uplode') }}">تحميل ملف  </a>

       
        <br>
        <br>
        <form action="{{ url('a_t_m_file_uploads/export') }}" method="GET">
          <button type="submit" class="btn btn-outline-success">Export Report</button>
      </form>
        <div class="row">
          <div class="row">
            <div class="col-md-3">
                        <div class="form-group">
                        <label>الفرع</label>
                        <select type="text" name="terminal_id" id="terminal_id"
                                                class="form-control">
                                                <option value="10000004">فرع زليتن</option>
                                                <option value="10000005">فرع طريق الشط</option>
                                                <option value="10000003">الرئيسي</option>
                                                <option value="10000002">مصراتة</option>
                                                <option value="10000001">فرع برج طرابلس</option>
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

            <button type="button" class="btn btn-info" id="filteredRecords">اجمالي الحركات بعد التصفية  : 0</button>
          </div>
          <br>
            <div class="row">
            <button type="button" class="btn btn-warning" id="tfee">  Total Fee : 0</button>

            <button type="button" class="btn btn-danger" id="bfee">  Bank Fee : 0</button>

             
           </div>
<br>
<br>

  <div class="table-responsive">
    <table class="table table-striped" style="width: 100%" id="a_t_m_file_uploads_tbl">
        <thead>
            <tr>
                <th>ID</th>
                <th>Terminal ID</th>
                <th>Terminal Name</th>
                <th>Bank Name</th>
                <th>Total Amount</th>
                <th>Processing Date</th>
                <th>Total Amount 1</th>
                <th>Transaction Number</th>
                <th>Total Fee</th>
                <th>Bank Fee</th>
            </tr>
        </thead>
        
      <tbody>

      </tbody>
      <script src="{{asset('assets/plugin/jquery.js') }}" ></script>

      <script type="text/javascript">



$(document).ready(function(){
  fill_datatable();
          function fill_datatable(terminal_id='')
          {
            var table = $('#a_t_m_file_uploads_tbl').DataTable({
                "initComplete": function(settings, json) {
                    var api = this.api();


                    var totalFee = api.column('tot_fee:name').data().reduce(function(a, b) {

                      var a = parseFloat(a);
                      var b = parseFloat(b);

                    return a + b;
                }, 0);
                var bank_fee = api.column('bank_fee:name').data().reduce(function(a, b) {
                  var a = parseFloat(a);
                  var b = parseFloat(b);
                    return a + b;
                }, 0)
                    var totalRecords = json.recordsTotal; // This should be available in the server response
                      filteredRecords= json.recordsFiltered
                $('#total').text("الحركات:" + totalRecords); // Total records
                $('#filteredRecords').text(" الحركات  التصفية: " + filteredRecords); // Filtered records
                $('#tfee').text("Total Fee:" + totalFee.toFixed(3) +"LYD");
                $('#bfee').text("Bank Fee:" + bank_fee.toFixed(3) +"LYD");

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
              url: "{{ route('a_t_m_file_uploads') }}",
              data:{terminal_id:terminal_id,
              }

            },

              columns: [
                
              
                   {
                      "data": "id",
                      render: function (data, type, row, meta) {

                          return meta.row + meta.settings._iDisplayStart + 1;
                      }
                  },
                    {data: 'terminal_id', name: 'terminal_id'},
                    {data: 'terminal_name', name: 'terminal_name'},
                    {data: 'bank_name', name: 'bank_name'},
                    {data: 'total_amount', name: 'total_amount'},
                    {data: 'processing_date', name: 'processing_date'},
                    {data: 'total_amount_1', name: 'total_amount_1'},
                    {data: 'trx_no', name: 'trx_no'},
                    {data: 'tot_fee', name: 'tot_fee'},
                    {data: 'bank_fee', name: 'bank_fee'},
                  




              ]
          });
          }

       
        $('#reset').click(function(){
            $('#terminal_id').val('');
            $('#a_t_m_file_uploads_tbl').DataTable().destroy();
        fill_datatable();
         });



      



         $('#filter').click(function(){
        var terminal_id = $('#terminal_id').val();



            $('#a_t_m_file_uploads_tbl').DataTable().destroy();
            fill_datatable(terminal_id)


    });
        });


      </script>
    </table>

  </div>


      </div>
  </div>



@endsection



