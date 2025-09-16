<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Dashboard Admin</h2>
    <p><a href="{{ route('admin.mahasiswa.create') }}">+ Tambah Mahasiswa</a></p>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    <h3>Daftar Mahasiswa</h3>
    <ul>
        @foreach($mahasiswa as $m)
            <li>{{ $m->username }}</li>
        @endforeach
    </ul>
</body>
</html>
