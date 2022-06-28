<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body style="background: lightgray">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Tambah Data Mahasiswa</h1>
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="foto">FOTO</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="foto">

                                @error('image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="number" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}">
                            </div>
                            <div class="form-group">
                                <label for="nama">NAMA</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">TANGGAL LAHIR</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            </div>
                            <div class="form-group mb-5">
                                <label for="ipk">IPK</label>
                                <input type="number" class="form-control @error('ipk') is-invalid @enderror" name="ipk" value="{{ old('ipk') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-warning">RESET</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>