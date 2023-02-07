@extends('layout.simple-layout')
@section('body')
<div class="row">
    <form action="@if (request()->route()->hasParameter("id")){{ route('update-pengaduan', [
        'id' => $pengaduan->id_pengaduan
    ]) }}
    @else{{ route('post-pengaduan') }}@endif" enctype="multipart/form-data" method="POST">

        @csrf

        {{-- UPDATE LOGIC --}}
        @if (request()->route()->hasParameter("id"))
            @method('PATCH')
        @endif

        <div class="mb-1">
            <label for="">Tgl Pengaduan</label>
            <input value="@if (request()->route()->hasParameter("id")){{ $pengaduan->tgl_pengaduan }}@endif" class="form-control" type="date" name="tgl_pengaduan">
        </div>

        <div class="mb-1">
            <label for="">Laporan</label>
            <textarea class="form-control" name="isi_laporan" cols="30" rows="10">@if (request()->route()->hasParameter("id")){{ $pengaduan->isi_laporan }}@endif
            </textarea>
        </div>

        <div class="mb-1">
            <label for="">Foto</label>
            <input value="@if (request()->route()->hasParameter("id")){{ $pengaduan->foto }}@endif" class="form-control" type="file" name="foto">
        </div>

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>

{{-- LIST OGF PENGADUAN --}}
<div class="row mt-4">
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Pengaduan</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Tanggapan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduans as $pengaduan)
            <tr>
                <td><img width="200px" src="{{ $pengaduan->foto }}" alt=""></td>
                <td>{{ $pengaduan->isi_laporan }}</td>
                <td>{{ $pengaduan->tgl_pengaduan }}</td>
                <td>{{ $pengaduan->status }}</td>
                <td>{{ count($pengaduan->tanggapan) }} Tanggapan</td>
                <td>
                    {{-- VIEW TANGGAPAN --}}
                    <a href="{{ route('tanggapan', [
                        'id' => $pengaduan->id_pengaduan
                    ]) }}" class="btn btn-info">Lihat Tanggapan</a>

                    {{-- EDIT --}}
                    <a href="{{ route('pengaduan', [
                        'id' => $pengaduan->id_pengaduan
                    ]) }}" class="btn btn-warning">Edit</a>

                    {{-- DELETE --}}
                    <form action="{{ route('destroy-pengaduan', [
                        'id' => $pengaduan->id_pengaduan
                    ]) }}" method="POST">
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- ADD THE LOGOUT COMPONENT --}}
@include('masyarakat.logout-compt')
@endsection
