<x-layout :title="$kategori->nama_kategori">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
        <div>
            <h1 class="h3 page-title mb-1">{{ $kategori->nama_kategori }}</h1>
            <div class="text-muted">Kode {{ $kategori->kode_kategori }}</div>
        </div>
        <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-del">Ubah kategori</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th class="text-center">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bukus as $buku)
                        <tr>
                            <td class="text-nowrap">{{ $buku->isbn }}</td>
                            <td><a href="{{ route('buku.show', $buku) }}" class="text-decoration-none">{{ $buku->judul }}</a></td>
                            <td>{{ $buku->penulis }}</td>
                            <td class="text-center">{{ $buku->stok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-5">
                                Belum ada buku di kategori ini. <a href="{{ route('buku.create') }}">Tambah buku</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-end">{{ $bukus->links() }}</div>
    <a href="{{ route('kategori.index') }}" class="d-inline-block mt-2">Kembali ke daftar kategori</a>
</x-layout>