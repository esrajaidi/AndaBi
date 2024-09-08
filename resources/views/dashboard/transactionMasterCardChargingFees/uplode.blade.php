@extends('layouts.dashboard_app')
@section('title', 'تحميل ملف عمولة شحن بطاقة ماستر كارد ')


@section('content')
<div class="container-fluid">
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('transaction_master_card_charging_fees') }}"> الرجوع  </a>
    </div>
    
</div>
<br>
<br>
<div class="row small-spacing">
    <div class="col-lg-8 col-xs-12">
        <div class="box-content card white">
            
            <h3 class="box-title">تحميل ملف </h3>
            <!-- /.box-title -->
            
            <div class="card-content">
                <form  method="post" action="{{ route('transaction_master_card_charging_fees/store_uplode') }}"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> ملف excel </label>
                                <input type="file" class="form-control"  name="file" />
                                @error('file')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>
                    
                    </div>
                
              

                <button type="submit" class="btn btn-success btn-fill pull-left"> تحميل </button>
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

