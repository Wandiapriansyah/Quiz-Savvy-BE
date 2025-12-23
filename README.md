# Quiz-Savvy Backend

Quiz-Savvy adalah **Backend REST API** untuk aplikasi quiz berbasis web yang dibangun menggunakan **Laravel 10**.  
Project ini dikembangkan sebagai hasil kolaborasi **Frontend dan Backend**, di mana backend berperan sebagai penyedia data quiz, soal, jawaban, hasil, serta sistem autentikasi.

---

## 🚀 Tech Stack

-   PHP >= 8.x
-   Laravel 10
-   Laravel Sanctum (Authentication)
-   Database: MySQL / PostgreSQL
-   REST API

---

## 👥 Tim Pengembang

-   **Backend Developer**: Wandi Apriansyah
-   **Frontend Developer**: DavaGhifary

---

## 📌 Fitur Utama

-   Authentication menggunakan **Laravel Sanctum**
-   Register, Login, dan Logout user
-   Role-based access:
    -   **Admin**
    -   **User**
-   Manajemen quiz
-   Manajemen kategori quiz
-   Manajemen soal quiz pilihan ganda
-   Manajemen jawaban
-   Sistem quiz dengan **timer**
-   Penyimpanan hasil quiz
-   Rekap jawaban user
-   REST API untuk integrasi Frontend

---

## 🔐 Authentication & Authorization

Project ini menggunakan **Laravel Sanctum** dengan sistem token berbasis Bearer Token.

### 🔑 Alur Authentication

-   **Register**
    -   User mendaftar dengan `nama`, `email`, dan `password`
    -   Role default otomatis sebagai **User**
-   **Login**
    -   User login dan mendapatkan token
-   **Logout**
    -   Token aktif dihapus (logout per device)

### 📌 Role Pengguna

| Role ID | Role  | Keterangan                    |
| ------- | ----- | ----------------------------- |
| 1       | Admin | Mengelola quiz, soal, jawaban |
| 2       | User  | Mengerjakan quiz              |

### 📎 Header untuk Endpoint Terproteksi

Authorization: Bearer {token}

---

## ⚙️ Instalasi & Menjalankan Project

### 1️⃣ Clone Repository

```bash
git clone https://github.com/username/Quiz-Savvy.git

cd Quiz-Savvy
```

### 2️⃣ Install Dependency

```bash
composer install
```

### 3️⃣ Konfigurasi Environment

Salin file .env.example menjadi .env:

```bash
cp .env.example .env
```

Konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quiz_savvy
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Generate Application Key

```bash
php artisan key:generate
```

### 5️⃣ Migrasi Database

```bash
php artisan migrate
```

Project ini **tidak menggunakan seeder**.
Data quiz dan soal dimasukkan melalui API atau Frontend.

### 6️⃣ Jalankan Server

```bash
php artisan serve
```

Server berjalan di:

```cpp
http://127.0.0.1:8000
```

## 🔌 Dokumentasi API

### 🔐 Authentication

| Method | Endpoint        | Deskripsi          |
| ------ | --------------- | ------------------ |
| POST   | `/api/register` | Register user      |
| POST   | `/api/login`    | Login user         |
| POST   | `/api/logout`   | Logout user (auth) |

### 📚 Master Data

| Method       | Endpoint               | Deskripsi              |
| ------------ | ---------------------- | ---------------------- |
| API Resource | `/api/roles`           | Manajemen role         |
| API Resource | `/api/users`           | Manajemen user         |
| API Resource | `/api/categories`      | Kategori quiz          |
| API Resource | `/api/quiz-categories` | Relasi quiz & kategori |

### 📝 Quiz & Soal

| Method       | Endpoint         | Deskripsi         |
| ------------ | ---------------- | ----------------- |
| API Resource | `/api/quiz`      | Manajemen quiz    |
| API Resource | `/api/questions` | Manajemen soal    |
| API Resource | `/api/anwers`    | Manajemen jawaban |

#### Custom endpoint:

| Method | Endpoint                                | Deskripsi             |
| ------ | --------------------------------------- | --------------------- |
| GET    | `/api/questions-with-answers/{quiz_id}` | Soal + jawaban        |
| POST   | `/api/edit-questions/{quizId}`          | Edit soal             |
| POST   | `/api/edit-anwers/{quizId}`             | Edit jawaban          |
| POST   | `/api/edit-title/{quizId}`              | Edit judul quiz       |
| GET    | `/api/myQuiz`                           | Quiz yang dibuat user |

### 📊 Hasil Quiz

| Method       | Endpoint             | Deskripsi     |
| ------------ | -------------------- | ------------- |
| API Resource | `/api/results`       | Hasil quiz    |
| API Resource | `/api/recap-jawaban` | Rekap jawaban |

## 🔗 Integrasi Frontend

Frontend dikebangkan secara terpisah oleh kolaborator.
Reposiroty Frontend dapat dihubungkan langsung melalui GitHub atau dokumentasi Frontend.

Pastikan Base URL API sudah sesuai pada konfigurasi Frontend.
