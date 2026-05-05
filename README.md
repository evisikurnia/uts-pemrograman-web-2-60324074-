# UTS Pemrograman Web 2 — Sistem Manajemen Kategori Buku
**Nama:** Eka Visi Kurnia  
**NIM:** 60324074

---

## Deskripsi singkat aplikasi:
Aplikasi ini adalah sistem sederhana untuk mengelola data kategori buku di perpustakaan.
Di dalam aplikasi ini, pengguna bisa menambah, melihat, mengedit, dan menghapus data kategori buku dengan mudah melalui tampilan web.

---

## Cara instalasi dan menjalankan aplikasi:
### 1. Download atau clone repository ini
      https://github.com/evisikurnia/uts-pemrograman-web-2-60324074
### 2. Pindahkan folder project ke: 
  - XAMPP: ```C:\xampp\htdocs\```
  - Laragon:  ```C:\laragon\www\```
### 3. Jalankan XAMPP:
  - Aktifkan Apache
  - Aktifkan MySQL
### 4. Import database:
  - Buka phpMyAdmin (http://localhost/phpmyadmin)
  - Buat database dengan nama:
    
```
    uts_perpustakaan_60324074
```
  - Klik tab Import
  - Upload file:

```
    database_backup.sql
```
### 5. Konfigurasi database:
- Edit file:
```
config/database
```
- sesuaikan:
```
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '123');
```
### 6. Jalankan aplikasi dibrowser:
      http://localhost/uts_60324074/

---

## Struktur folder:

```
uts_perpustakaan_60324074/
├── config/
│   └── database.php
├── index.php
├── create.php
├── edit.php
├── delete.php
└── database_backup.sql
```

---

### Link repository github:
```
https://github.com/evisikurnia/uts-pemrograman-web-2-60324074-
```
