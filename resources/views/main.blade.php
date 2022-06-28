@extends('layouts.admin')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Daftar Mahasiswa
                </h3>
            </div>
            <a href="{{ route('mahasiswa.create') }}" class="btn btn-success mb-3">Tambah Mahasiswa</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">FOTO</th>
                        <th scope="col">NIM</th>
                        <th scope="col">NAMA</th>
                        <th scope="col">TANGGAL LAHIR</th>
                        <th scope="col">IPK</th>
                        <th scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswas as $mahasiswa)
                        <tr>
                            <td>
                                <img src="{{ Storage::url('public/foto/') . $mahasiswa->foto }}" class="img-thumbnail"
                                    style="width: 50px">
                            </td>
                            <td>{{ $mahasiswa->nim }}</td>
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>{{ $mahasiswa->tanggal_lahir }}</td>
                            <td>{{ $mahasiswa->ipk }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST">
                                    <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}"
                                        class="btn btn-sm btn-primary">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">Data Mahasiswa Belum Tersedia</div>
                    @endforelse
                </tbody>
            </table>
        </div>
        @include('elements.footer')
    </div>
@endsection
