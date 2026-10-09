@props(['title' => null])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ? $title . ' — ' : '' }}SIPUS-Del — Institut Teknologi Del</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --del-purple: #4C1D95;        /* warna utama Del Royal Purple */
            --del-purple-dark: #3B0764;   /* hover */
            --del-purple-soft: #EDE9FE;   /* header tabel */
            --paper: #F9F8FD;             /* latar halaman, hampir putih */
        }
        body { background-color: var(--paper); }

        .navbar-del { background-color: var(--del-purple); }
        .navbar-del .nav-link { color: rgba(255,255,255,.75); }
        .navbar-del .nav-link:hover,
        .navbar-del .nav-link.active { color: #fff; box-shadow: inset 0 -3px 0 #fff; }

        .btn-del { background-color: var(--del-purple); color: #fff; border-color: var(--del-purple); }
        .btn-del:hover, .btn-del:focus { background-color: var(--del-purple-dark); color: #fff; border-color: var(--del-purple-dark); }
        .btn-outline-del { color: var(--del-purple); border-color: var(--del-purple); }
        .btn-outline-del:hover { background-color: var(--del-purple); color: #fff; }

        .table thead th { background-color: var(--del-purple-soft); color: var(--del-purple-dark); border-bottom: 2px solid var(--del-purple); }

        .page-link { color: var(--del-purple); }
        .page-item.active .page-link { background-color: var(--del-purple); border-color: var(--del-purple); color: #fff; }

        .form-control:focus, .form-select:focus { border-color: var(--del-purple); box-shadow: 0 0 0 .2rem rgba(76,29,149,.2); }

        a { color: var(--del-purple); }
        .page-title { color: var(--del-purple-dark); }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-del shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('buku.index') }}">SIPUS-Del</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                    aria-controls="navMenu" aria-expanded="false" aria-label="Buka menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}" href="{{ route('buku.index') }}">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}" href="{{ route('kategori.index') }}">Kategori</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container pb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        {{ $slot }}
    </main>

    <footer class="text-center text-muted small pb-4">
        Sistem Informasi Perpustakaan Kampus Del &copy; {{ date('Y') }} — Institut Teknologi Del
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>