<x-layout title="Daftar Kategori">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 page-title mb-0">Daftar Kategori</h1>
        <a href="{{ route('kategori.create') }}" class="btn btn-del">Tambah kategori</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama kategori</th>
                        <th class="text-center">Jumlah buku</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $kategori)
                        <tr>
                            <td>{{ $kategoris->firstItem() + $loop->index }}</td>
                            <td class="text-nowrap">{{ $kategori->kode_kategori }}</td>
                            <td><a href="{{ route('kategori.show', $kategori) }}" class="fw-semibold text-decoration-none">{{ $kategori->nama_kategori }}</a></td>
                            <td class="text-center">{{ $kategori->bukus_count }}</td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-sm btn-outline-del">Ubah</a>
                                <form action="{{ route('kategori.destroy', $kategori) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus kategori ini beserta {{ $kategori->bukus_count }} buku di dalamnya?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                Belum ada kategori. <a href="{{ route('kategori.create') }}">Tambah kategori pertama</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-end">{{ $kategoris->links() }}</div>
</x-layout>