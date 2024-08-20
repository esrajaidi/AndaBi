
@extends('layouts.dashboard_app')
@section('title', ' مراقبة النظام')
@section('content')
<div class="row small-spacing">
    <div class="col-xs-12">
      <div class="box-content">
        <h3 ><i class="ico fa fa-eye"></i> @yield('title')</h3>
        <br>
       
       

        <br>
        <br>
       
  <div class="table-responsive">
    <table class="table table-striped" style="width: 100%" id="logger_tbl">
      <thead>
         <tr>
          <th>ر.ق</th>
          <th>description </th>
          <th>userId</th>
          <th>userAgent </th>
          <th>created_at</th>

         </tr>
      </thead> 
      <tbody>
      
      </tbody>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  
      <script type="text/javascript">
        $(function () {
          
          var table = $('#logger_tbl').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('logger/activity') }}",
              columns: [
                   {
                      "data": "id",
                      render: function (data, type, row, meta) {
                        
                          return meta.row + meta.settings._iDisplayStart + 1;
                      }
                  },
                  {data: 'description', name: 'description'},
                  {data: 'username', name: 'username'},
                  {data: 'userAgent', name: 'userAgent'},
                  {data: 'created_at', name: 'created_at'},

              ]
          });
          
        });
      </script>
    </table>
  
  </div>
       
  
      </div>
  </div>
  


@endsection



