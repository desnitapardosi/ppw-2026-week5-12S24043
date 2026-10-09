<x-layout title="Ubah Kategori">
    <h1 class="h3 page-title mb-3">Ubah Kategori</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('kategori.update', $kategori) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                @include('kategori._form')
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-del">Simpan perubahan</button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>