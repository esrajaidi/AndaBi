@extends('layouts.dashboard_app')
@section('title', 'تفريغ الجدول')

@section('content')
<div class="container-fluid">
    <div class="pull-right">
    </div>
    @if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

</div>
<br>
<div class="row small-spacing">
    <div class="col-lg-8 col-xs-12">
        <div class="box-content card white">
            
            <h3 class="box-title"> تفريغ جدول </h3>
            <!-- /.box-title -->
            
            <div class="card-content">
                <form action="{{ route('delete-table') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control" for="table"> قم بتحديد الجدول المراد تفريغه</label>
                                <select name="table" id="table" required>
                                    <option value="">الجداول</option>
                                    @foreach($tableNames as $table)
                                        <option value="{{ $table }}">{{ $table }}</option>
                                    @endforeach
                                </select>
                        
                                @error('table')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> 
                                @enderror
                            </div>
                        </div>
                    
                    </div>
                
              

                    <button type="submit" class="btn btn-success btn-fill pull-left" onclick="return confirm('Are you sure you want to delete this table?')">تفريغ الجدول</button>
                    <div class="clearfix"></div>
            </form>
            <br>
            <form method="POST" action="{{ route('migrate-refresh-seed') }}">
                @csrf
                <button type="submit" class="btn btn-success btn-fill pull-left"  onclick="return confirm('Are you sure you want to refresh and seed the database?');">
                    Migrate Refresh & Seed
                </button>
            </form>
          
            </div>
            <br>  
            <br>

            <!-- /.card-content -->
        </div>
        <!-- /.box-content -->
    </div>
    <!-- /.col-lg-6 col-xs-12 -->


  
  
</div>



    @endsection
