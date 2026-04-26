# Sistem Fuzzy PHP (Konversi dari JavaScript)

Proyek ini adalah versi PHP dari sistem sebelumnya (Node.js + React).

## Stack

- PHP 8+
- SQLite (PDO)
- Tailwind (CDN)
- Chart.js (CDN)
- Routing sederhana via `.htaccess`

## Struktur

- [index.php](index.php): router utama untuk halaman web + API
- [app/Services/FuzzyService.php](app/Services/FuzzyService.php): logika Fuzzy Mamdani
- [app/Controllers/ApiController.php](app/Controllers/ApiController.php): controller endpoint API
- [app/Repositories/AssessmentRepository.php](app/Repositories/AssessmentRepository.php): query SQLite
- [views/pages](views/pages): halaman Home, Assessment, History, Detail
- [database/database.sqlite](database/database.sqlite): database (dibuat otomatis)

## Endpoint API

- GET [api](api)
- POST [api/assessments](api/assessments)
- GET [api/assessments](api/assessments)
- GET [api/assessments/{id}](api/assessments/1)
- DELETE [api/assessments/{id}](api/assessments/1)

## Cara menjalankan di XAMPP

1. Pastikan Apache aktif.
2. Pastikan folder proyek ada di:
   - `C:\xampp\htdocs\Sistem Fuzzy PHP`
3. Buka di browser:
   - `http://localhost/Sistem%20Fuzzy%20PHP/`

Database SQLite akan dibuat otomatis saat request pertama.

## Catatan

- Rule fuzzy, membership function, inferensi MIN, agregasi MAX, dan defuzzifikasi centroid sudah dikonversi 1:1 dari versi JavaScript.
- Halaman web sudah mencakup: Home, Penilaian, Riwayat, dan Detail.
