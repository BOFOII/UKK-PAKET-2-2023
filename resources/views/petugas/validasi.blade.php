@extends('layout.simple-layout')
@section('body')
<div class="mt-4">
    <form action="{{ route('post-validasi') }}" method="POST">
        @csrf
        <label for="">Pengaduan</label>
        <select class="form-select" name="id_pengaduan">
            <option value="">Pilih pengaduan</option>
            @foreach ($pengaduans as $pengaduan)
            <option value="{{ $pengaduan->id_pengaduan }}">{{ $pengaduan->masyarakat->nama }} - {{ $pengaduan->isi_laporan }}</option>
            @endforeach
        </select>
        <br>

        <label for="">Status</label>
        <select class="form-select" name="status">
            <option value="()">Tidak ada</option>
            <option value="proses">Proses</option>
            <option value="selesai">Selesai</option>
        </select>
        <br>

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</div>
<div class="mt-4">
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Masyarakat</th>
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
                <td>{{ $pengaduan->masyarakat->nama }}</td>
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
                    <a href="" class="btn btn-warning">Edit</a>

                    {{-- DELETE --}}
                    <form action="" method="POST">
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('petugas.logout-compt')
@endsection
