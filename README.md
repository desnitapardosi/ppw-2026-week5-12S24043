# SIPUS-Del — Sistem Informasi Perpustakaan Kampus Del

Tugas Mandiri Minggu 5 — Pemrograman & Pengujian Web (12S3101), Institut Teknologi Del.

- Nama: Desnita Pardosi
- NIM: 12S24043

Aplikasi CRUD perpustakaan berbasis **Laravel 11** (MVC, server-side rendering).

## Fitur
- CRUD Buku dan Kategori (`Route::resource` + Implicit Route Model Binding)
- Relasi Eloquent: Kategori hasMany Buku, Buku belongsTo Kategori
- Eager Loading (`Buku::with('kategori')`) di halaman index
- Validasi server-side (`$request->validate()`), `@csrf`, method spoofing
- Layout `<x-layout>` bertema Del Purple (#4C1D95), pagination Bootstrap 5, flash message, `@forelse`
- Pencarian dan filter kategori
- Seeder + Factory (Faker): 5 kategori, 24 buku
- Audit kueri SQL via `DB::listen` (lihat `docs/sql-audit.log`)

## Instalasi
Prasyarat: PHP 8.2/8.3 (pdo_sqlite, mbstring, openssl, fileinfo, curl), Composer 2.6+.

```bash
git clone https://github.com/desnitapardosi/ppw-2026-week5-12S24043.git
cd ppw-2026-week5-12S24043
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite      # Windows: type nul > database\database.sqlite
php artisan migrate:fresh --seed
php artisan serve
```
Buka http://127.0.0.1:8000

## Bukti Eager Loading (N+1)
Lihat `docs/sql-audit.log`: jumlah kueri halaman `/buku` konstan (count pagination,
select bukus, select kategoris `where id in (...)`, dan dropdown filter), tidak bertambah
per baris. Tanpa `with('kategori')`, kueri kategori menjadi 1 per baris (N+1).

## Konvensi commit
Conventional Commits, contoh: `feat(migration): create kategoris and bukus tables schema`.