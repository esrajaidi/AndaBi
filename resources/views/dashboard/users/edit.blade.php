@extends('layouts.dashboard_app')
@section('title', 'تعديل بيانات مستخدم')




@section('content')
<div class="container-fluid">
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('users') }}"> الرجوع  </a>
    </div>
    
</div>
<br>
<br>

<div class="row small-spacing">
    <div class="col-lg-8 col-xs-12">
        <div class="box-content card white">
            <h3 class="box-title">  تعديل بيانات مستخدم</h3>

            <!-- /.box-title -->
            
            <div class="card-content">
                <form action="" method="POST" enctype="multipart/form-data" >
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> اسم المستخدم</label>
                                <input type="text" class="form-control" name="username" value="{{$user->username}}"   placeholder=  "اسم المستخدم"  >
                                @error('username')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>البريد الإلكتروني</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}"    placeholder="البريد الإلكتروني" >
                                @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                            </div>
                        </div>
                      
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>كلمةالمرور</label>

                                <input type="password" class="form-control" name="password" value="{{ $user->email }}"  value="{{old('password')}}" placeholder="كلمةالمرور" >
                                @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> تاكيد كلمةالمرور</label>
                                <input type="password" class="form-control" name="confirm-password"  value="{{old('confirm-password')}}" placeholder="تاكيد كلمة المرور" >
                                @error('confirm-password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label> الصلاحية</label>
                                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                                @error('roles')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label > الفرع  </label>
                            

                                <select type="text" name="branches_id"
                                        class="form-control">
                                        
                                        <option label="اختر الفرع"></option>
                                        @forelse ($branches as $branche)
                                        
                                            <option value="{{ $branche->id }}" {{ $user->branches_id == $branche->id ? 'selected' : '' }}> {{ $branche->branche_name }}
                                            </option>
                                        @empty
                                            <option value="">لا يوجد فروع</option>
                                        @endforelse
                                </select>
                                @error('branches_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                    </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-fill pull-left">تعديل مستخدم </button>
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







