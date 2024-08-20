@extends('layouts.dashboard_app')
@section('title', 'تعديل بيانات صلاحية')


@section('content')
<div class="container-fluid">
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('roles') }}"> الرجوع  </a>
    </div>
    
</div>
<br>
<br>
<div class="row small-spacing">
    <div class="col-lg-8 col-xs-12">
        <div class="box-content card white">
            <h3 class="box-title">  تعديل بيانات صلاحية</h3>

            <!-- /.box-title -->
            
            <div class="card-content">
                <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                    
                    @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label> الاسم </label>

                            <input type="text" class="form-control" name="name" value="{{ $role->name }}"  placeholder="الاسم " >
                            @error('name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                    </div>
                 
                   
                  
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>الاذونات:</strong>
                        <br/>
                        @foreach($permission as $value)
                        <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                            {{ $value->name }}</label>
                        <br/>
                        @endforeach
                        @error('permission')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span> 
                    @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-fill pull-left">تعديل  صلاحية </button>
                <div class="clearfix"></div>
            </form>
            </div>

            <!-- /.card-content -->
        </div>
        <!-- /.box-content -->
    </div>
    <!-- /.col-lg-6 col-xs-12 -->


  
  
</div>





@endsection

