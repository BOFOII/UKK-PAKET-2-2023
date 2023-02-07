@extends('layout.simple-layout')
@section('body')
<form action="" method="POST">
    @csrf
    <div class="mb-1">
        <label for="">Username</label>
        <input class="form-control" type="text" name="username">
    </div>

    <div class="mb-1">
        <label for="">Password</label>
        <input class="form-control" type="password" name="password">
    </div>

    <button class="btn btn-primary">Submit</button>
</form>

@endsection
