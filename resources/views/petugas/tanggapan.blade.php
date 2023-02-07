@extends('layout.simple-layout')
@section('body')
    <div class="row mt-">
        <form
            action="@if (request()->route()->hasParameter('id')) {{ route('update-tanggapan', [
                'id' => $tanggapan->id_tanggapan,
            ]) }}@else{{ route('post-tanggapan-admin') }}@endif"
            method="POST">

            @csrf

            @if (request()->route()->hasParameter('id'))
                <div class="mb-1">
                    <h3>Update Tanggapan</h3>
                </div>
                @method('PATCH')
            @else
                <div class="mb-1">
                    <h3>Taambah Tanggapan</h3>
                </div>
            @endif

            <div class="mb-1">
                <label for="">Penagduan</label>
                <select class="form-select" name="id_pengaduan">
                    <option value="">Pilih pengaduan</option>
                    @foreach ($pengaduans as $pengaduan)
                        <option value="{{ $pengaduan->id_pengaduan }}">{{ $pengaduan->masyarakat->nama }} -
                            {{ $pengaduan->isi_laporan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-1">
                <label for="">Tanggal Tanggapan</label>
                <input value="@if (request()->route()->hasParameter('id')){{ $tanggapan->tgl_tanggapan }}@endif" class="form-control"
                    type="date" name="tgl_tanggapan">
            </div>

            <div class="mb-1">
                <label for="">Tanggapan</label>
                <textarea class="form-control" name="tanggapan" cols="30" rows="10">
@if (request()->route()->hasParameter('id'))
{{ $tanggapan->tanggapan }}
@endif
</textarea>
            </div>

            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
    <div class="row mt-4">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Pengaduan</th>
                    <th>Tangal Tanggapan</th>
                    <th>Tanggapan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tanggapans as $tanggapan)
                    <tr>
                        <td>{{ $tanggapan->pengaduan->masyarakat->nama }} - {{ $tanggapan->pengaduan->isi_laporan }}</td>
                        <td>{{ $tanggapan->tgl_tanggapan }}</td>
                        <td>{{ $tanggapan->tanggapan }}</td>
                        <td>
                            {{-- EDIT --}}
                            <a href="{{ route('tanggapan-petugas', [
                                'id' => $tanggapan->id_tanggapan,
                            ]) }}"
                                class="btn btn-warning">Edit</a>

                            {{-- DELETE --}}
                            <form
                                action="{{ route('destroy-tanggapan', [
                                    'id' => $tanggapan->id_tanggapan,
                                ]) }}"
                                method="POST">
                                @csrf
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
