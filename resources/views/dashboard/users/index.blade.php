@extends('layouts.dashboard_app')
@section('title', 'إدارة المستخدمين')


@section('content')


<div class="row small-spacing">
  <div class="col-xs-12">
    <div class="box-content">
      <h3 ><i class="ico fa fa-users"></i> @yield('title')</h3>
      <br>
        @can('user-create')
  <a class="btn btn-success" href="{{ route('users/create') }}">   إضافة مستخدم جديد </a>
  @endcan
<div class="table-responsive">
  <table class="table table-striped">
    {{-- <caption>Optional table caption.</caption> --}}
    <thead>
       <tr>
                 <th>ر.ق</th>
                 <th>الاسم</th>
                 <th>البريدالالكتروني</th>
                 <th>الصلاحية</th>
                 <th> حالة الحساب</th>

                 <th ></th>
    </thead> 
    <tbody> 
      @foreach ($data as $key => $user)
      <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
        <td>
          @if(!empty($user->getRoleNames()))
            @foreach($user->getRoleNames() as $v)
               <label class="badge badge-info">{{ $v }}</label>
            @endforeach
          @endif
        </td>
        @if($user->active==1)          
      <td>  <span class="notice " style="background: green;color:white">مفعل</span> </td>         
      @else
      <td>  <span class="notice notice-danger">معطل</span> </td>         

      @endif
        <td>
           <a class="btn btn-info" href="{{ route('users/show',encrypt($user->id)) }}">عرض</a>
           @can('user-edit')
           <a class="btn btn-primary" href="{{ route('users/edit',encrypt($user->id)) }}">تعديل</a>
           @endcan
           @can('user-changestatus')

           @if($user->active==1)          
            <a class="btn btn-danger" href="{{ route('users/changeStatus',encrypt($user->id)) }}"> الغاء تفعيل</a>
            @else
            <a class="btn btn-success" href="{{ route('users/changeStatus',encrypt($user->id)) }}">  تفعيل</a>
            @endif
            @endcan
            @can('user-delete')

            {!! Form::open(['method' => 'DELETE','route' => ['users/destroy', encrypt($user->id)],'style'=>'display:inline']) !!}
            {!! Form::submit('الغاء', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
            @endcan
        </td>
      </tr>
     @endforeach
    </tbody> 
  </table>
  {!! $data->render() !!}

</div>
     

    </div>
  <!-- /.col-lg-6 col-xs-12 -->
</div>





@endsection
