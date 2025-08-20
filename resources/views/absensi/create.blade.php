<!DOCTYPE html>
<html>

<head>
    <title>Form Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">
    <div class="container">
        <h2>Absensi Rapat: {{ $rapat->judul }}</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('absensi.store', ['rapat' => $rapat->id]) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Instansi / Bagian</label>
                <input type="text" name="instansi" class="form-control">
            </div>
            <div class="mb-3">
                <label>Jabatan</label>
                <input type="text" name="jabatan" class="form-control">
            </div>
            <div class="mb-3">
                <label>No HP / Email</label>
                <input type="text" name="kontak" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Simpan Absensi</button>
        </form>
    </div>
</body>

</html>
