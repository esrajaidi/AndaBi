@extends('layouts.dashboard_app')
@section('title', 'الرئسية')

@section('content')
<div class="row small-spacing">
    <div class="col-xs-12">

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('delete-table') }}" method="POST">
        @csrf
        <label for="table">Select a table to delete:</label>
        <select name="table" id="table" required>
            <option value="">-- Select a table --</option>
            @foreach($tableNames as $table)
                <option value="{{ $table }}">{{ $table }}</option>
            @endforeach
        </select>

        <button type="submit" onclick="return confirm('Are you sure you want to delete this table?')">Delete Table</button>
    </form>
    </div>
</div>

    @endsection
