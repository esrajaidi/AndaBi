@extends('layouts.dashboard_app')
@section('title', ' تغير كلمة المرور')


@section('content')
<div class="container-fluid">
    <div class="pull-right">
    </div>
    
</div>
<br>
<br>

<div class="row small-spacing">
    <div class="col-lg-8 col-xs-12">
        <div class="box-content card white">
            <h3 class="box-title">  تغير كلمةالمرور</h3>

            <!-- /.box-title -->
            
            <div class="card-content">
                <form action="{{ route('update-password') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> كلمة المرور القديمة </label>
                                <input name="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" id="oldPasswordInput"
                                    placeholder="Old Password">
                                @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> كلمة المرور الجديدة </label>
                                <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPasswordInput"
                                    placeholder="New Password">
                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label >  تاكيد كلمة المرور الجديدة </label>
                                <input name="new_password_confirmation" type="password" class="form-control" id="confirmNewPasswordInput"
                                    placeholder="Confirm New Password">
                              
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn-fill pull-left">تعديل  </button>
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


