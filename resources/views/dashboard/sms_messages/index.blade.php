
@extends('layouts.dashboard_app')
@section('title', 'إدارة الرسائل')
@section('content')
<div class="row small-spacing">
    <div class="col-xs-12">
      <div class="box-content">
        <h3 ><i class="ico fa fa-comment-o"></i> @yield('title')</h3>
        <br>
        @can('send-sms-messages')
        <a class="btn btn-success" href="{{ route('sms_messages/create') }}">إرسال رسالة</a>


        @endcan 
        @can('bulk-send-sms-messages')
        <a class="btn btn-success" href="{{ route('sms_messages/send_by_excel') }}">تحميل ملف excel</a>


        @endcan 

        <br>
        <br>
        @can('sms-messages')
       
  <div class="table-responsive">
    <table class="table table-striped" style="width: 100%" id="sms_message_tbl">
      <thead>
         <tr>
          <th>ر.ق</th>
          <th>رقم الهاتف</th>
          <th> وقت الارسال</th>
          <th>  نص الرسالة</th>
          <th>حالة الرسالة</th>
         </tr>
      </thead> 
      <tbody>
      
      </tbody>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
  
      <script type="text/javascript">
        $(function () {
          
          var table = $('#sms_message_tbl').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('sms_messages/sms_messages') }}",
              columns: [
                   {
                      "data": "id",
                      render: function (data, type, row, meta) {
                        
                          return meta.row + meta.settings._iDisplayStart + 1;
                      }
                  },
                  {data: 'phone_number', name: 'phone_number'},
                  {data: 'message_time', name: 'message_time'},
                  {data: 'message_text', name: 'message_text'},
                  {data: 'message_status', name: 'message_status'},

              ]
          });
          
        });
      </script>
    </table>
  
  </div>
       
  
  @endcan
      </div>
  </div>
  


@endsection



