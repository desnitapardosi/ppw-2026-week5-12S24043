<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class KategoriController extends Controller
{
    public function index(): View
    {
        $kategoris = Kategori::withCount('bukus')
            ->orderBy('nama_kategori')
            ->paginate(10);

        return view('kategori.index', compact('kategoris'));
    }

    public function create(): View
    {
        return view('kategori.create', ['kategori' => new Kategori]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules(), $this->messages());

        Kategori::create($validated);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(Kategori $kategori): View
    {
        $bukus = $kategori->bukus()->latest()->paginate(10);

        return view('kategori.show', compact('kategori', 'bukus'));
    }

    public function edit(Kategori $kategori): View
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori): RedirectResponse
    {
        $validated = $request->validate($this->rules($kategori), $this->messages());

        $kategori->update($validated);

        return redirect()->route('kategori.index')->with('success', 'Perubahan kategori berhasil disimpan.');
    }

    public function destroy(Kategori $kategori): RedirectResponse
    {
        $kategori->delete(); // buku terkait ikut terhapus (cascadeOnDelete)

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    private function rules(?Kategori $kategori = null): array
    {
        return [
            'kode_kategori' => ['required', 'string', 'max:10', Rule::unique('kategoris', 'kode_kategori')->ignore($kategori?->id)],
            'nama_kategori' => ['required', 'string', 'min:3', 'max:100'],
        ];
    }

    private function messages(): array
    {
        return [
            'required' => 'Kolom :attribute wajib diisi.',
            'kode_kategori.unique' => 'Kode kategori ini sudah dipakai. Gunakan kode lain.',
            'kode_kategori.max' => 'Kode kategori maksimal 10 karakter.',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter.',
        ];
    }
}