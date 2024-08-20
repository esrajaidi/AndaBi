@extends('layouts.dashboard_app')
@section('title', 'عرض بيانات الصلاحية')


@section('content')
<div class="container-fluid">
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('roles') }}"> الرجوع  </a>
    </div>
    
</div>
<br>
<br>

<div class="col-xs-12">
    <div class="box-content card">
        <h4 class="box-title">  بيانات الصلاحية  
            <a class="pull-left text-white" href="{{ route('roles/edit',encrypt($role->id)) }}">تعديل</a>

        </h4>
        <!-- /.box-title -->
        
     
        <div class="card-content">
            <div class="row">
              
                <!-- /.col-md-6 -->
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-xs-1"><label>اسم </label></div>
                        <!-- /.col-xs-5 -->
                        <div class="col-xs-7">{{ $role->name }}</div>
                        <!-- /.col-xs-7 -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-5"><label>الاذونات:</label></div>

            </div>
            <br>
            <div class="row">

                <!-- /.col-md-6 -->
                        <!-- /.col-xs-5 -->
                        <ul class="list-inline">
                            @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                            <li class="margin-bottom-10"><button type="button" class="btn btn-success waves-effect waves-light">{{ $v->name }}</button></li>
                            @endforeach
                        @endif
                        </ul>
                            
                       
                        <!-- /.col-xs-7 -->
                 
                    <!-- /.row -->
                
               
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-content -->
    </div>
    <!-- /.box-content card -->
</div>

@endsection
