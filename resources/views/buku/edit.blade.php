<x-layout title="Ubah Buku">
    <h1 class="h3 page-title mb-3">Ubah Buku</h1>
    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('buku.update', $buku) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                @include('buku._form')
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" class="btn btn-del">Simpan perubahan</button>
                    <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-layout>