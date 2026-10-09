<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class BukuController extends Controller
{
    public function index(Request $request): View
    {
        $term = trim((string) $request->query('q', ''));

        // Eager Loading: jumlah kueri tetap, tidak N+1
        $bukus = Buku::with('kategori')
            ->when($term !== '', fn ($query) => $query->where(function ($w) use ($term) {
                $w->where('judul', 'like', "%{$term}%")
                    ->orWhere('penulis', 'like', "%{$term}%")
                    ->orWhere('isbn', 'like', "%{$term}%");
            }))
            ->when($request->filled('kategori_id'), fn ($query) => $query->where('kategori_id', $request->query('kategori_id')))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('buku.index', [
            'bukus' => $bukus,
            'kategoris' => Kategori::orderBy('nama_kategori')->get(),
        ]);
    }

    public function create(): View
    {
        return view('buku.create', [
            'buku' => new Buku,
            'kategoris' => Kategori::orderBy('nama_kategori')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules(), $this->messages());

        Buku::create($validated);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function show(Buku $buku): View
    {
        $buku->load('kategori');

        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku): View
    {
        return view('buku.edit', [
            'buku' => $buku,
            'kategoris' => Kategori::orderBy('nama_kategori')->get(),
        ]);
    }

    public function update(Request $request, Buku $buku): RedirectResponse
    {
        $validated = $request->validate($this->rules($buku), $this->messages());

        $buku->update($validated);

        return redirect()->route('buku.index')->with('success', 'Perubahan data buku berhasil disimpan.');
    }

    public function destroy(Buku $buku): RedirectResponse
    {
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }

    private function rules(?Buku $buku = null): array
    {
        return [
            'isbn' => ['required', 'digits:13', Rule::unique('bukus', 'isbn')->ignore($buku?->id)],
            'judul' => ['required', 'string', 'min:5', 'max:200'],
            'penulis' => ['required', 'string', 'max:150'],
            'penerbit' => ['required', 'string', 'max:100'],
            'tahun_terbit' => ['required', 'integer', 'min:1900', 'max:' . now()->year],
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'stok' => ['required', 'integer', 'min:0'],
            'sinopsis' => ['nullable', 'string'],
        ];
    }

    private function messages(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'isbn.digits' => 'ISBN harus terdiri dari 13 digit angka tanpa tanda hubung.',
            'isbn.unique' => 'ISBN ini sudah terdaftar. Gunakan ISBN lain.',
            'judul.min' => 'Judul minimal 5 karakter.',
            'tahun_terbit.min' => 'Tahun terbit minimal 1900.',
            'tahun_terbit.max' => 'Tahun terbit tidak boleh melebihi tahun ini.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak ditemukan.',
            'stok.min' => 'Stok tidak boleh kurang dari 0.',
            'integer' => 'Kolom :attribute harus berupa bilangan bulat.',
        ];
    }
}