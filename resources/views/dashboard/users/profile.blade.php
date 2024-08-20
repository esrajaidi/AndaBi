@extends('layouts.dashboard_app')
@section('title', 'الملف الشخصي')


@section('content')
<div class="container-fluid">
    
    
</div>
<br>
<br>
<div class="row small-spacing">
    <div class="col-md-3 col-xs-12">
        <div class="box-content bordered primary margin-bottom-20">
            <div class="profile-avatar">
                @if(Auth::user()->image==null)
                <img src="http://placehold.it/450x450" alt="">
                @else
                <img src="{{asset('public/images/users/files_'.Auth::user()->username)}}/{{ Auth::user()->image }}" alt="" style="width: 230px;height:230px">
                @endif
                <form action="{{ route('users/uploadPersonImage') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="row"> <br>   
                            <div class="col-md-12">
                                <div class="form-group">
        
                                    <input type="file" id="personal_image" name="personal_image" class="form-control">
                                    @error('personal_image')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span> 
                                    @enderror
                                </div>
                       
                            </div>     
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-block btn-friend"><i class="fa fa-check-circle"></i>تحميل صورة الشصية</button>
                            </div>     
                        </div>
                    </form>
            </div>
            <!-- .profile-avatar -->
           
        </div>
        <!-- /.box-content bordered -->

       
        <!-- /.box-content -->
    </div>
    <!-- /.col-md-3 col-xs-12 -->
    <div class="col-md-9 col-xs-12">
        <div class="row">
            <div class="col-xs-12">
                <div class="box-content card">
                    <h4 class="box-title">   حول  
                        {{-- <a class="pull-left text-white" href="{{ route('users/edit',encrypt($user->id)) }}">تعديل</a> --}}
            
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
                            
                            <!-- /.col-md-6 -->
                       
                            <!-- /.col-md-6 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-content -->
                </div>
                <!-- /.box-content card -->
            </div>
            {{-- <div class="col-xs-12">
                <div class="box-content card">
                    <h4 class="box-title"> About</h4>
                    <!-- /.box-title -->
                    <div class="dropdown js__drop_down">
                        <a href="#" class="dropdown-icon glyphicon glyphicon-option-vertical js__drop_down_button"></a>
                        <ul class="sub-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else there</a></li>
                            <li class="split"></li>
                            <li><a href="#">Separated link</a></li>
                        </ul>
                        <!-- /.sub-menu -->
                    </div>
                    <!-- /.dropdown js__dropdown -->
                    <div class="card-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-5"><label>First Name:</label></div>
                                    <!-- /.col-xs-5 -->
                                    <div class="col-xs-7">Betty</div>
                                    <!-- /.col-xs-7 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-5"><label>Last Name:</label></div>
                                    <!-- /.col-xs-5 -->
                                    <div class="col-xs-7">Simmons</div>
                                    <!-- /.col-xs-7 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-5"><label>User Name:</label></div>
                                    <!-- /.col-xs-5 -->
                                    <div class="col-xs-7">Betty</div>
                                    <!-- /.col-xs-7 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-5"><label>Email:</label></div>
                                    <!-- /.col-xs-5 -->
                                    <div class="col-xs-7">youremail@gmail.com</div>
                                    <!-- /.col-xs-7 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-5"><label>City:</label></div>
                                    <!-- /.col-xs-5 -->
                                    <div class="col-xs-7">Los Angeles</div>
                                    <!-- /.col-xs-7 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-5"><label>Country:</label></div>
                                    <!-- /.col-xs-5 -->
                                    <div class="col-xs-7">United States</div>
                                    <!-- /.col-xs-7 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-5"><label>Birthday:</label></div>
                                    <!-- /.col-xs-5 -->
                                    <div class="col-xs-7">Jan 22, 1984</div>
                                    <!-- /.col-xs-7 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-5"><label>Interests:</label></div>
                                    <!-- /.col-xs-5 -->
                                    <div class="col-xs-7">Basketball, Web, Design, etc.</div>
                                    <!-- /.col-xs-7 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-5"><label>Website:</label></div>
                                    <!-- /.col-xs-5 -->
                                    <div class="col-xs-7"><a href="#">yourwebsite.com</a></div>
                                    <!-- /.col-xs-7 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-5"><label>Phone:</label></div>
                                    <!-- /.col-xs-5 -->
                                    <div class="col-xs-7">+1-234-5678</div>
                                    <!-- /.col-xs-7 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.col-md-6 -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-content -->
                </div>
                <!-- /.box-content card -->
            </div> --}}
            <!-- /.col-md-12 -->
          
            <!-- /.col-md-6 -->
        </div>
       
        <!-- /.row -->
    </div>
    <!-- /.col-md-9 col-xs-12 -->
</div>


@endsection