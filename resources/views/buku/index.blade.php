<x-layout title="Daftar Buku">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <h1 class="h3 page-title mb-0">Daftar Buku</h1>
        <a href="{{ route('buku.create') }}" class="btn btn-del">Tambah buku</a>
    </div>

    <form method="GET" action="{{ route('buku.index') }}" class="row g-2 mb-3">
        <div class="col-md-6">
            <input type="search" name="q" value="{{ request('q') }}" class="form-control"
                   placeholder="Cari judul, penulis, atau ISBN" aria-label="Cari buku">
        </div>
        <div class="col-md-4">
            <select name="kategori_id" class="form-select" aria-label="Filter kategori">
                <option value="">Semua kategori</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" @selected(request('kategori_id') == $kategori->id)>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-outline-del" type="submit">Cari</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ISBN</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th class="text-center">Stok</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($bukus as $buku)
                        <tr>
                            <td>{{ $bukus->firstItem() + $loop->index }}</td>
                            <td class="text-nowrap">{{ $buku->isbn }}</td>
                            <td><a href="{{ route('buku.show', $buku) }}" class="fw-semibold text-decoration-none">{{ $buku->judul }}</a></td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ $buku->kategori->nama_kategori }}</td>
                            <td class="text-center">
                                @if ($buku->stok === 0)
                                    <span class="badge text-bg-danger">Habis</span>
                                @else
                                    {{ $buku->stok }}
                                @endif
                            </td>
                            <td class="text-end text-nowrap">
                                <a href="{{ route('buku.edit', $buku) }}" class="btn btn-sm btn-outline-del">Ubah</a>
                                <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus buku ini? Tindakan ini tidak bisa dibatalkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                @if (request()->hasAny(['q', 'kategori_id']))
                                    Tidak ada buku yang cocok dengan pencarian. Ubah kata kunci atau
                                    <a href="{{ route('buku.index') }}">tampilkan semua buku</a>.
                                @else
                                    Belum ada buku. <a href="{{ route('buku.create') }}">Tambah buku pertama</a>.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex flex-wrap justify-content-between align-items-center mt-3">
        <small class="text-muted">
            @if ($bukus->total() > 0)
                Menampilkan {{ $bukus->firstItem() }}–{{ $bukus->lastItem() }} dari {{ $bukus->total() }} buku
            @endif
        </small>
        {{ $bukus->links() }}
    </div>
</x-layout>