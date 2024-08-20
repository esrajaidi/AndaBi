@extends('layouts.dashboard_app')
@section('title', 'إضافة صلاحية')


@section('content')
<div class="container-fluid">
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('roles') }}"> الرجوع  </a>
    </div>
    
</div>
<br>
<br>


<br>
<br>

<div class="row small-spacing">
    <div class="col-lg-8 col-xs-12">
        <div class="box-content card white">
            
            <h3 class="box-title">مستخدم جديد</h3>
            <!-- /.box-title -->
            
            <div class="card-content">
                <form  method="post" action="{{ route('roles/store') }}" >
                    @csrf
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label> الاسم </label>

                            <input type="text" class="form-control" name="name" value="{{old('name')}}"  placeholder="الاسم " >
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
                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
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

                    <button type="submit" class="btn btn-success btn-fill pull-left">إضافة صلاحية </button>

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

