@extends('layouts.dashboard_app')
@section('title', 'تعديل بيانات فرع')


@section('content')
<div class="container-fluid">
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('branches') }}"> الرجوع  </a>
    </div>
    
</div>
<br>
<br>
<div class="row small-spacing">
    <div class="col-lg-8 col-xs-12">
        <div class="box-content card white">
            
            <h3 class="box-title">تعديل بيانات فرع </h3>
            <!-- /.box-title -->
            
            <div class="card-content">
                <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> رقم الفرع </label>
                                <input type="text" class="form-control" maxlength="3" size="3" name="branche_number" value="{{ $branche->branche_number }}"  placeholder="رقم الفرع " >
                                @error('branche_number')
                                    <span class="text-danger" branche="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> اسم الفرع </label>
                                <input type="text" class="form-control" name="branche_name"  maxlength="50" value="{{ $branche->branche_name }}"  placeholder="اسم الفرع " >
                                @error('branche_name')
                                    <span class="text-danger" branche="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-fill pull-left">تعديل  فرع </button>
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

