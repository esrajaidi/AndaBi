
@extends('layouts.dashboard_app')
@section('title', 'قوائم الحظر المحلية ')
@section('content')
<div class="row small-spacing">
    <div class="col-xs-12">
      <div class="box-content">
        <h3 ><i class="ico fa fa-list-ul"></i> @yield('title')</h3>
        <br>

        @can('local_block_lists-uplode')

        <a class="btn btn-success" href="{{ route('local_block_lists/uplode') }}">تحميل ملف  قوائم الحظر المحلية</a>

       @endcan

       @can('local_block_lists-create')

        <a class="btn btn-success" href="{{ route('local_block_lists/create') }}">اضافة شركة لقوائم الحظر المحلية</a>

       @endcan
       @can('local_block_lists-export')

       <a class="btn btn-success" href="{{ route('local_block_lists/export') }}">تصدير  قوائم الحظر المحلية</a>

      @endcan

        <br>
        <br>
        @canany(['local_block_lists-search-statement', 'local_block_lists-search'])

        <div class="row">
          <div class="row">
            @can('local_block_lists-search-statement')

            <div class="col-md-3">
                <div class="form-group">
                    <label>البيان</label>
                    <input type="text" name="statement" id="statement" class="form-control" placeholder="بحث من خلال البيان فقط">

                </div>
            </div>
            @endcan
            @can('local_block_lists-search')

            <div class="col-md-3">
              <div class="form-group">
                  <label>الرقم الاشاري</label>
                  <input type="text" name="index" id="index" class="form-control" placeholder="بحث من خلال الرقم الاشاري فقط">

              </div>
            </div>
              <div class="col-md-3">
                <div class="form-group">
                    <label>تاريخ  الرسالة الواردة </label>
                    <input type="date" name="dateofreceivedMessage" id="dateofreceivedMessage" class="form-control">

                </div>
              </div>
              @endcan
             

          </div>
          <div class="row">
            <div class="form-group" align="center">
              <button type="button" name="filter" id="filter" class="btn btn-info">بحث</button>

              <button type="button" name="reset" id="reset" class="btn btn-default">تحديث</button>
              @can('local_block_lists-print')


              <button type="button" name="print" id="print" style="display: none" class="btn btn-warning">طباعة</button>

              @endcan
          </div>
          </div>

        </div>
        @endcanany

        @can('local_block_lists')

  <div class="table-responsive">
    <table class="table table-striped" style="width: 100%" id="local_block_lists_tbl">
      <thead>
         <tr>
          
          <th></th>
          <th>ر.ت</th>
          <th>البيان</th>
          <th>الجهة التي أصدرت التجميد</th>
          <th> تاريخ الرسالة الواردة</th>
          <th>الرقم الاشاري</th>
          <th>الملاحظات</th>
          <th></th>
         </tr>
      </thead>
      <tbody>

      </tbody>
      <script src="{{asset('assets/plugin/jquery.js') }}" ></script>

      <script type="text/javascript">



$(document).ready(function(){
  fill_datatable();
          function fill_datatable(statement='',index='',dateofreceivedMessage='')
          {
            var table = $('#local_block_lists_tbl').DataTable({
            processing: true,
            serverSide: true,
            searching: false,

            ajax: {
              url: "{{ route('local_block_lists') }}",
              data:{statement:statement,
                 index:index,
                 dateofreceivedMessage:dateofreceivedMessage
              }

            },

              columns: [
                
                {data: 'checkbox', name: 'checkbox'},
                   {
                      "data": "id",
                      render: function (data, type, row, meta) {

                          return meta.row + meta.settings._iDisplayStart + 1;
                      }
                  },
                  {data: 'statement', name: 'statement'},
                  {data: 'hiddenBy', name: 'hiddenBy'},
                  {data: 'dateofreceivedMessage', name: 'dateofreceivedMessage'},
                  {data: 'index', name: 'index'},
                  {data: 'notes', name: 'notes'},
                  {data: 'edit', name: 'edit'},




              ]
          });
          }

          function getCheckedRowsData() {
                var checkedData = [];
                $('.row-checkbox:checked').each(function() {
                  var tbl=$('#local_block_lists_tbl').DataTable();

                    var row = $(this).closest('tr'); 
                    var rowData = tbl.row(row).data(); // Get the data for the row
                    var statement = rowData['statement']; // Adjust index as needed
                    // Find the closest row
                    checkedData.push(statement); // Add to the array
                });
                return checkedData;
            }
        $('#reset').click(function(){
        $('#statement').val('');
        $('#index').val('');
        $('#dateofreceivedMessage').val('');
        $('#local_block_lists_tbl').DataTable().destroy();
        fill_datatable();
         });


         $('#print').click(function() {
    var tbl = $('#local_block_lists_tbl').DataTable();
    var data = getCheckedRowsData(); // Retrieve checked rows data
    var matched = data.length;
    var statement = $('#statement').val();
    var totalRecords = tbl.page.info().recordsDisplay;

    // Prepare URL parameters
    var params = new URLSearchParams({
        statement: statement,
        totalRecords: totalRecords,
        matched: matched,
        list: JSON.stringify(data) // Convert array to JSON string for safe transmission
    });

    var url = '{{ url("local_block_lists/print") }}'; 
    // Append parameters to URL
    window.location.href = `${url}?${params.toString()}`;
});

        //  $('#print').click(function(){

        //   var tbl=$('#local_block_lists_tbl').DataTable();
        //   var data = getCheckedRowsData();
        //   var list_=data;
        //   var matched=data.length;
        //     var tdcount=$('#local_block_lists_tbl tbody tr td').length;
        //     var statement = $('#statement').val();
        //     var totalRecords =$("#local_block_lists_tbl").DataTable().page.info().recordsDisplay;
        //     var array=[statement,totalRecords,matched,list_];
        //     info = array.toString();
        //     var url = '{{ url("local_block_lists/print", "paramters") }}';
        //     url = url.replace('paramters', info);


        //     window.location.href =  url;
        //  });



         $('#filter').click(function(){
        var statement = $('#statement').val();
        var index = $('#index').val();


          $("#print").css("display", "inline-block");


        var dateofreceivedMessage = $('#dateofreceivedMessage').val();
            $('#local_block_lists_tbl').DataTable().destroy();
            fill_datatable(statement, index,dateofreceivedMessage);


    });
        });


      </script>
    </table>

  </div>


  @endcan
      </div>
  </div>



@endsection



