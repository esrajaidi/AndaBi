@extends('layouts.dashboard_app')
@section('title', 'إدارة الصلاحيات')


@section('content')

<div class="row small-spacing">
    <div class="col-xs-12">
      <div class="box-content">
        <h3 ><i class="ico fa fa-key"></i> @yield('title')</h3>
        <br>
        @can('role-create')
        <a class="btn btn-success" href="{{ route('roles/create') }}">   إضافة صلاحية جديد </a>
        @endcan   
  <div class="table-responsive">
    <table class="table table-striped">
      {{-- <caption>Optional table caption.</caption> --}}
      <thead>
         <tr>
                    <th>ر.ق</th>
                   <th>الاسم</th>
                   <th></th>
         </tr>
      </thead> 
      <tbody>
        @foreach ($roles as $key => $role)
        <tr>
           <td>{{ ++$i }}</td>
           <td>{{ $role->name }}</td>
           <td>
             <a class="btn btn-info" href="{{ route('roles/show',encrypt($role->id)) }}">عرض</a>
             @can('role-edit')
                 <a class="btn btn-primary" href="{{ route('roles/edit',encrypt($role->id)) }}">تعديل</a>
             @endcan
             @can('role-delete')
                 {!! Form::open(['method' => 'DELETE','route' => ['roles/destroy', encrypt($role->id)],'style'=>'display:inline']) !!}
                     {!! Form::submit('الغاء', ['class' => 'btn btn-danger']) !!}
                 {!! Form::close() !!}
             @endcan
         </td>
         </tr>
        @endforeach
      </tbody>
    </table>
    {!! $roles->render() !!}
  
  </div>
       
  
      </div>
    <!-- /.col-lg-6 col-xs-12 -->
  </div>
  









@endsection

