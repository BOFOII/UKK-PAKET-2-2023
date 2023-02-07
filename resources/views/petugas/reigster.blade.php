@extends('layout.simple-layout')
@section('body')
    <div class="row mt-4">
        <form action="@if (request()->route()->hasParameter('id')){{ route('update-petugas', [
            'id' => $petugas->id_petugas,
        ]) }}@else{{ route('post-register-petugas') }}@endif" method="POST">
            @csrf

            @if (request()->route()->hasParameter('id'))
            <div class="mb-1">
                <h1>Update Petugas</h1>
            </div>
            @method('PATCH')
            @else
            <div class="mb-1">
                <h1>Tambah Petugas</h1>
            </div>
            @endif

            <div class="mb-1">
                <label for="">Nama Petugas</label>
                <input value="
                @if (request()->route()->hasParameter('id')){{ $petugas->nama_petugas }}@endif" class="form-control" type="text" name="nama_petugas">
            </div>
            <div class="mb-1">
                <label for="">Username</label>
                <input value="@if (request()->route()->hasParameter('id')){{ $petugas->username }}@endif" class="form-control" type="text" name="username">
            </div>
            <div class="mb-1">
                <label for="">Password</label>
                <input class="form-control" type="password" name="password">
            </div>
            <div class="mb-1">
                <label for="">Telpon</label>
                <input value="@if (request()->route()->hasParameter('id')){{ $petugas->telp }}@endif" class="form-control" type="text" name="telpon">
            </div>
            <div class="mb-1">
                <label for="">Level</label>
                <select name="level" class="form-select">
                    <option value="">Pilih Level</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="row mt-4">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Nama Petugas</th>
                    <th>Username</th>
                    <th>Telp</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffs as $staff)
                <tr>
                    <td>{{ $staff->nama_petugas }}</td>
                    <td>{{ $staff->username }}</td>
                    <td>{{ $staff->telp }}</td>
                    <td>{{ $staff->level }}</td>
                    <td>
                        <a href="{{ route('register-petugas', [
                            'id' => $staff->id_petugas
                        ]) }}" class="btn btn-warning">Edit</a>
                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
