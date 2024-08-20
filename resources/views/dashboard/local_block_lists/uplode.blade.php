@extends('layouts.dashboard_app')
@section('title', 'تحميل ملف excel')


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
            
            <h3 class="box-title">تحميل قوائم الحظر المحلية </h3>
            <!-- /.box-title -->
            
            <div class="card-content">
                <form  method="post" action="{{ route('local_block_lists/store_uplode') }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> ملف excel </label>
                                <input type="file" class="form-control"  name="file_local_block_lists" />
                                @error('file_local_block_lists')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>
                    
                    </div>
                
              

                <button type="submit" class="btn btn-success btn-fill pull-left"> إرسال </button>
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

