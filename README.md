# Sistem Pakar Rekomendasi Strategi Belajar

Sistem pakar ini menggunakan metode **Forward Chaining** untuk memberikan rekomendasi strategi belajar berdasarkan gaya belajar dan kendala mahasiswa. Dibangun sepenuhnya menggunakan **PHP Native, HTML, CSS, dan MySQL** tanpa menggunakan framework apa pun.

## Cara Menjalankan Proyek

1. **Persiapan Environtment**
   - Pastikan Anda sudah menginstal **XAMPP** atau **Laragon**.
   - Taruh folder `sistem-pakar-strategi-belajar` di dalam folder `htdocs` (jika menggunakan XAMPP) atau `www` (jika menggunakan Laragon).

2. **Pengaturan Database**
   - Buka **phpMyAdmin** melalui browser (`http://localhost/phpmyadmin`).
   - Impor file `database.sql` ke dalam server Anda (ini akan otomatis membuat database `db_sistem_pakar_belajar` dan tabel `consultations`).

3. **Menjalankan Aplikasi**
   - Buka browser Anda.
   - Akses URL berikut: [http://localhost/sistem-pakar-strategi-belajar/](http://localhost/sistem-pakar-strategi-belajar/)

## Fitur Utama

- **Konsultasi**: Pengisian gejala/kendala yang dialami.
- **Inferensi**: Pemrosesan berbasis 18 Rules Forward Chaining.
- **Hasil & Evaluasi**: Analisa gaya belajar visual, auditori, kinestetik, dan masalah spesifik beserta rekomendasi strategi.
- **Riwayat Konsultasi**: Tersimpan di database, dan dilengkapi dengan fitur detail tiap entri, serta penghapusan riwayat.
