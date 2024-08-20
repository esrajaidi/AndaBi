@extends('layouts.dashboard_app')
@section('title', 'إدارة الفروع')
@section('content')
<div class="row small-spacing">
    <div class="col-xs-12">
      <div class="box-content">
        <h3 ><i class="ico fa fa-building"></i> @yield('title')</h3>
        <br>
        @can('branche-create')
        <a class="btn btn-success" href="{{ route('branches/create') }}">   إضافة فرع جديد </a>
        @endcan 
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
         <tr>
          <th>ر.ق</th>
          <th>رقم الفرع</th>
          <th>اسم الفرع</th>
          <th> حالة فرع</th>
          <th ></th>
         </tr>
      </thead> 
      <tbody>
        @foreach ($branches as $key => $branche)
        <tr>
           <td>{{ ++$i }}</td>
           <td>{{ $branche->branche_number }}</td>
           <td>{{ $branche->branche_name }}</td>
       
             @if($branche->active==1)          
             <td>  <span class="notice " style="background: green;color:white">مفعل</span> </td>         
             @else
             <td>  <span class="notice notice-danger">معطل</span> </td>         
             @endif
          

           <td>
             @can('branche-edit')

                 <a class="btn btn-primary" href="{{ route('branches/edit',encrypt($branche->id)) }}">تعديل</a>
            @endcan
            @can('branche-changestatus')

           @if($branche->active==1)          
           <a class="btn btn-danger" href="{{ route('branches/changeStatus',encrypt($branche->id)) }}"> الغاء تفعيل</a>
           @else
           <a class="btn btn-success" href="{{ route('branches/changeStatus',encrypt($branche->id)) }}">  تفعيل</a>
           @endif
           @endcan
                
         </td>
         </tr>
        @endforeach
      </tbody>
    </table>
    {!! $branches->render() !!}
  
  </div>
       
  
      </div>
    <!-- /.col-lg-6 col-xs-12 -->
  </div>
  


@endsection



