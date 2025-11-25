# LMS Cerdika 🎓

LMS Cerdika adalah platform Learning Management System (LMS) modern yang dibangun menggunakan **Laravel 11**. Aplikasi ini dirancang untuk memfasilitasi proses belajar mengajar secara daring dengan fitur manajemen kursus yang komprehensif, pelacakan progres siswa, forum diskusi interaktif, dan penerbitan sertifikat otomatis.

## 🚀 Fitur Utama

Aplikasi ini memiliki sistem *Role-Based Access Control* (RBAC) yang membagi pengguna menjadi tiga peran:

### 👨‍🎓 Student (Siswa)
* **Katalog Kursus:** Mencari dan mendaftar ke berbagai kursus yang tersedia berdasarkan kategori.
* **Manajemen Pembelajaran:** Mengakses materi pelajaran (teks & rich content) dengan urutan terstruktur.
* **Progres Belajar:** Melacak persentase penyelesaian materi secara *real-time*.
* **Forum Diskusi:** Bertanya atau berdiskusi dengan pengajar dan siswa lain pada setiap kursus.
* **Sertifikat Digital:** Mengunduh sertifikat PDF otomatis setelah menyelesaikan 100% materi.

### 👨‍🏫 Teacher (Pengajar)
* **Manajemen Kursus:** Membuat, mengedit, dan mengelola kursus yang diajarkan.
* **Manajemen Materi:** Menyusun kurikulum dan konten materi menggunakan *Rich Text Editor* (Trix).
* **Monitoring Siswa:** Memantau siapa saja yang mendaftar dan melihat progres belajar mereka.
* **Moderasi Forum:** Menjawab pertanyaan siswa di forum diskusi kursus.

### 👮‍♂️ Admin (Administrator)
* **Manajemen Pengguna:** Mengelola data seluruh pengguna (Tambah, Edit, Hapus, Blokir Akses).
* **Manajemen Kategori:** Mengelola kategori kursus untuk pengelompokan materi.
* **Kontrol Penuh:** Memiliki akses ke seluruh fitur pengajar dan manajemen sistem.

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel 11 (PHP Framework)
* **Frontend:** Blade Templates, Tailwind CSS
* **Database:** MySQL
* **Authentication:** Laravel Breeze
* **PDF Generator:** `barryvdh/laravel-dompdf` (Untuk cetak sertifikat)
* **Rich Text Editor:** Trix Editor (Untuk pembuatan konten materi)
* **Icons:** Heroicons (via Blade UI Kit / SVG)

## ⚙️ Prasyarat Sistem

* PHP >= 8.2
* Composer
* Node.js & NPM
* MySQL Database

## 📦 Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan projek ini di komputer lokal Anda:

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/username/LMS-Cerdika.git](https://github.com/username/LMS-Cerdika.git)
    cd LMS-Cerdika
    ```

2.  **Install Dependensi PHP**
    ```bash
    composer install
    ```

3.  **Install Dependensi Frontend**
    ```bash
    npm install
    ```

4.  **Konfigurasi Environment**
    Duplikat file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Setup Database & Seeding**
    Jalankan migrasi dan seeder untuk mengisi data awal (Admin, Kategori, dan Kursus Demo).
    ```bash
    php artisan migrate --seed
    ```

6.  **Jalankan Aplikasi**
    Buka dua terminal terpisah untuk menjalankan server Laravel dan Vite (untuk aset frontend).
    
    *Terminal 1:*
    ```bash
    php artisan serve
    ```
    *Terminal 2:*
    ```bash
    npm run dev
    ```

    Akses aplikasi di: `http://localhost:8000`

## 🔑 Akun Demo (Seeder)

Berdasarkan `DatabaseSeeder.php`, berikut adalah akun default yang dapat digunakan untuk pengujian:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@gmail.com` | `admin123` |
| **Student** | `siswa@example.com` | `password` |
| **Teacher** | *(Dibuat acak oleh factory)* | `password` |

> **Catatan:** Anda dapat melihat daftar email Teacher yang digenerate melalui database atau login sebagai Admin untuk melihat menu "Manajemen Pengguna".

## 📂 Struktur Folder Penting

Berikut adalah lokasi file-file inti dalam projek ini:

* `app/Http/Controllers`: Logika utama aplikasi (Course, Lesson, Thread, Certificate, dll).
* `app/Models`: Model Eloquent dan relasi database.
* `app/Policies`: Logika otorisasi (siapa yang boleh mengedit/menghapus).
* `database/migrations`: Struktur skema database.
* `resources/views`: Tampilan antarmuka pengguna (Blade Templates).
* `routes/web.php`: Definisi rute aplikasi.

## 📄 Lisensi

Projek ini bersifat *open-source* dan dilisensikan di bawah [MIT license](https://opensource.org/licenses/MIT).

---
**Dibuat dengan ❤️ untuk pendidikan.**