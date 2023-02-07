@extends('layout.simple-layout')
@section('body')
<div class="row mt-">
    <ul>
        <li>Pengaduan: {{ $pengaduan->isi_laporan }}</li>
        <li>Tanggal pendauan: {{ $pengaduan->tgl_pengaduan }}</li>
        <li>Bukti Foto: <img width="200px" src="{{ $pengaduan->foto }}" alt=""></li>
    </ul>
</div>
<div class="row mt-4">
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Tanggal Tanggapan</th>
                <th>Tanggapan</th>
                <th>Di Tanggapi Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan->tanggapan as $tanggapan)
                <tr>
                    <td>{{ $tanggapan->tgl_tanggapan }}</td>
                    <td>{{ $tanggapan->tanggapan }}</td>
                    <td>{{ $tanggapan->petugas->nama_petugas }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- ADD THE LOGOUT COMPONENT --}}
@include('masyarakat.logout-compt')
@endsection
