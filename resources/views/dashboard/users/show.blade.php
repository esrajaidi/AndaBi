@extends('layouts.dashboard_app')
@section('title', 'عرض بيانات مستخدم')


@section('content')
<div class="container-fluid">
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('users') }}"> الرجوع  </a>
    </div>
    
</div>
<br>
<br>
<div class="col-xs-12">
    <div class="box-content card">
        <h4 class="box-title">  بيانات مستخدم  
            <a class="pull-left text-white" href="{{ route('users/edit',encrypt($user->id)) }}">تعديل</a>

        </h4>
        <!-- /.box-title -->
        
     
        <div class="card-content">
            <div class="row">
              
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-xs-5"><label>اسم المستخدم</label></div>
                        <!-- /.col-xs-5 -->
                        <div class="col-xs-7"> {{ $user->username }}</div>
                        <!-- /.col-xs-7 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-xs-5"><label>البريدالالكتروني:</label></div>
                        <!-- /.col-xs-5 -->
                        <div class="col-xs-7"> 
                            {{ $user->email }}</div>
                        <!-- /.col-xs-7 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.col-md-6 -->
                
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-xs-5"><label>الصلاحية:</label></div>
                        <!-- /.col-xs-5 -->
                        <div class="col-xs-7">@if(!empty($user->getRoleNames()))
                            @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif</div>
                        <!-- /.col-xs-7 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.col-md-6 -->
                @if($user->branches_id!= null)
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-xs-5"><label>الفرع:</label></div>
                        <!-- /.col-xs-5 -->
                        <div class="col-xs-7"> 
                            {{ $user->branches->branche_name }}</div>
                        <!-- /.col-xs-7 -->
                    </div>
                    <!-- /.row -->
                </div>
                @endif
                <!-- /.col-md-6 -->
           
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-content -->
    </div>
    <!-- /.box-content card -->
</div>

@endsection