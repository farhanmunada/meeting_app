@foreach ($absensiTerbaru as $a)
    <tr>
        <td>{{ $a->rapat->judul }}</td>
        <td>{{ $a->nama }}</td>
        <td>{{ $a->instansi ?? '-' }}</td>
        <td>{{ $a->jabatan ?? '-' }}</td>
        <td>{{ $a->kontak ?? '-' }}</td>
        <td>{{ \Carbon\Carbon::parse($a->waktu_absen)->format('d M Y H:i') }}</td>
    </tr>
@endforeach
