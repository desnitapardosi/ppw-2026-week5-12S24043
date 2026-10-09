<x-layout :title="$buku->judul">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
        <div>
            <h1 class="h3 page-title mb-1">{{ $buku->judul }}</h1>
            <div class="text-muted">{{ $buku->penulis }}</div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('buku.edit', $buku) }}" class="btn btn-del">Ubah</a>
            <form action="{{ route('buku.destroy', $buku) }}" method="POST"
                  onsubmit="return confirm('Hapus buku ini? Tindakan ini tidak bisa dibatalkan.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Hapus</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">ISBN</dt>
                <dd class="col-sm-9">{{ $buku->isbn }}</dd>

                <dt class="col-sm-3">Kategori</dt>
                <dd class="col-sm-9">
                    <a href="{{ route('kategori.show', $buku->kategori) }}">{{ $buku->kategori->nama_kategori }}</a>
                </dd>

                <dt class="col-sm-3">Penerbit</dt>
                <dd class="col-sm-9">{{ $buku->penerbit }}</dd>

                <dt class="col-sm-3">Tahun terbit</dt>
                <dd class="col-sm-9">{{ $buku->tahun_terbit }}</dd>

                <dt class="col-sm-3">Stok</dt>
                <dd class="col-sm-9">
                    @if ($buku->stok === 0)
                        <span class="badge text-bg-danger">Habis</span>
                    @else
                        {{ $buku->stok }} eksemplar
                    @endif
                </dd>

                <dt class="col-sm-3">Sinopsis</dt>
                <dd class="col-sm-9 mb-0">{!! nl2br(e($buku->sinopsis ?: 'Belum ada sinopsis.')) !!}</dd>
            </dl>
        </div>
    </div>

    <a href="{{ route('buku.index') }}" class="d-inline-block mt-3">Kembali ke daftar buku</a>
</x-layout>