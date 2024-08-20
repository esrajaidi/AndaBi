@extends('layouts.dashboard_app')
@section('title', 'ضافة شركة لقوائم الحظر المحلية')


@section('content')
<div class="container-fluid">
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('local_block_lists') }}"> الرجوع  </a>
    </div>
    
</div>
<br>
<br>
<div class="row small-spacing">
    <div class="col-lg-8 col-xs-12">
        <div class="box-content card white">
            
            <h3 class="box-title"> @yield('title') </h3>
            <!-- /.box-title -->
            
            <div class="card-content">
                <form  method="post" action="{{ route('local_block_lists/store') }}" >
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>  البيان </label>
                                <input type="text" class="form-control"  name="statement" value="{{old('statement')}}"  placeholder="البيان " >
                                @error('statement')
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
                                <label>  الجهة التي أصدرت التجميد </label>
                                <input type="text" class="form-control"  name="hiddenBy" value="{{old('hiddenBy')}}"  placeholder="الجهة التي أصدرت التجميد " >
                                @error('hiddenBy')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>
                        
                    
                    </div>
              
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label> تاريخ الرسالة الواردة  </label>
                                <input type="date" class="form-control"  name="dateofreceivedMessage" value="{{old('dateofreceivedMessage')}}"  >
                                @error('dateofreceivedMessage')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>  الرقم الاشاري </label>
                                <input type="text" class="form-control"  name="index" value="{{old('index')}}"  placeholder="الرقم الاشاري " >
                                @error('index')
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
                                <label> ملاحظه</label>
    
                                <textarea type="text" class="form-control" name="notes"   cols="50" rows="10"   placeholder="ملاحظه " >
                                    {{old('notes')}}
                                </textarea>
    
                                @error('notes')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>
                    </div>

                <button type="submit" class="btn btn-success btn-fill pull-left"> اضافة </button>
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

