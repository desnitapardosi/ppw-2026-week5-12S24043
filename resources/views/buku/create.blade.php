<x-layout title="Tambah Buku">
    <h1 class="h3 page-title mb-3">Tambah Buku</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('buku.store') }}" method="POST" novalidate>
                @csrf
                @include('buku._form')
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-del">Simpan buku</button>
                    <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>