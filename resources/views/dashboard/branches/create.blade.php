@extends('layouts.dashboard_app')
@section('title', 'إضافة فرع')


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
            
            <h3 class="box-title">فرع جديد</h3>
            <!-- /.box-title -->
            
            <div class="card-content">
                <form  method="post" action="{{ route('branches/store') }}" >
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> رقم الفرع </label>
                                <input type="text" class="form-control" maxlength="3" size="3" name="branche_number" value="{{old('branche_number')}}"  placeholder="رقم الفرع " >
                                @error('branche_number')
                                    <span class="text-danger" role="alert">
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

                            <input type="text" class="form-control" name="branche_name"  maxlength="50" value="{{old('branche_name')}}"  placeholder="اسم الفرع " >
                            @error('branche_name')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                    </div>
                 
                   
                  
                </div>
              

                <button type="submit" class="btn btn-success btn-fill pull-left">إضافة فرع </button>
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

