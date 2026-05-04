Nama: Eka Visi Kurnia
NIM: 60324074

Deskripsi singkat aplikasi:
Aplikasi ini adalah sistem sederhana untuk mengelola data kategori buku di perpustakaan.
Di dalam aplikasi ini, pengguna bisa menambah, melihat, mengedit, dan menghapus data kategori buku dengan mudah melalui tampilan web.

Cara instalasi dan menjalankan aplikasi:
1.Download atau salin link repository ini
2.Pindahkan folder project ke: 
  C:\xampp\htdocs\perpustakaan
3.Jalankan XAMPP:
  - Aktifkan Apache
  - Aktifkan MySQL
4.Import database:
  - Buka phpMyAdmin (http://localhost/phpmyadmin)
  - Buat database dengan nama:
    uts_perpustakaan_60324074
  -Klik tab Import
  -Upload file:
    database_backup.sql
5.Jalankan aplikasi dibrowser:
  http://localhost/uts_60324074/

Struktur folder:
    uts_perpustakaan_60324074/
├── config/
│   └── database.php   → file koneksi database
├── index.php          → halaman utama (tampil data)
├── create.php         → tambah data kategori
├── edit.php           → edit data kategori
├── delete.php         → hapus data kategori
└── database_backup.sql → file database

Link repository github:
https://github.com/evisikurnia/uts-pemrograman-web-2-60324074-
