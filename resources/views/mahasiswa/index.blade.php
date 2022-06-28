<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body style="background: lightgray">
    <div class="container mt-5">
        <h1>DAFTAR MAHASISWA</h1>
        <div class="row">
          <div class="col-md-12">
            <div class="card border-0 shadow rounded">
              <div class="card-body">
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
                        <img src="{{ Storage::url('public/foto/').$mahasiswa->foto }}" class="img-thumbnail" style="width: 100px">
                      </td>
                      <td>{{ $mahasiswa->nim }}</td>
                      <td>{{ $mahasiswa->nama }}</td>
                      <td>{{ $mahasiswa->tanggal_lahir }}</td>
                      <td>{{ $mahasiswa->ipk }}</td>
                      <td class="text-center">
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST">
                          <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="btn btn-sm btn-primary">EDIT</a>
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
            </div>
          </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        //message with toastr
        @if(session()->has('success'))
        
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 

        @elseif(session()->has('error'))

            toastr.error('{{ session('error') }}', 'GAGAL!'); 
            
        @endif
    </script>
  </body>
</html>