@extends('layout.simple-layout')
@section('body')
<div class="row mt-1">
    <form action="{{ route('export-laporan') }}" method="GET">
        @csrf
        <div class="row mt-1">
            <div class="col">
                <label for="">Dari Tanggal</label>
                <input class="form-control" type="date" name="fromdate">
            </div>
            <div class="col">
                <label for="">Sampai Tanggap</label>
                <input class="form-control" type="date" name="todate">
            </div>
        </div>
        <div class="row mt-1">
            <label for="">Format</label>
            <select name="type" class="form-select">
                <option value="excel">EXCEL</option>
                <option value="pdf">PDF</option>
            </select>
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
