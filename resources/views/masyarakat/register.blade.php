@extends('layout.simple-layout')
@section('body')
<form action="{{ route('post-register') }}}" method="POST">
    @csrf
    <div class="mb-1">
        <label for="">NIk</label>
        <input class="form-control" type="text" name="nik">
    </div>

    <div class="mb-1">
        <label for="">Nama</label>
        <input class="form-control" type="text" name="nama">
    </div>

    <div class="mb-1">
        <label for="">Username</label>
        <input class="form-control" type="text" name="username">
    </div>

    <div class="mb-1">
        <label for="">Telp</label>
        <input class="form-control" type="text" name="telp">
    </div>

    <div class="mb-1">
        <label for="">Password</label>
        <input class="form-control" type="password" name="" id="">
    </div>

    <button class="btn btn-primary" type="submit">Submit</button>
</form>
@endsection
