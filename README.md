![logo](public/images/logo.png)

# TaskNest Sistem Manajemen Tugas Kelompok

## Deskripsi Proyek
TaskNest adalah sebuah aplikasi berbasis web yang dirancang untuk membantu tim dalam mengelola proyek, mengatur tugas, dan meningkatkan kolaborasi. Aplikasi ini memungkinkan pengguna untuk membuat proyek, menetapkan tugas kepada anggota tim, melacak kemajuan, dan berkomunikasi melalui komentar.

## Fitur Utama
- **Manajemen Proyek:** CRUD untuk membuat, membaca, memperbarui, dan menghapus proyek.
- **Manajemen Tugas:** Penugasan tugas ke anggota tim, pengelompokan berdasarkan proyek, dan pelacakan status tugas.
- **Komentar:** Sistem komentar untuk komunikasi antaranggota tim dalam setiap tugas.
- **Dashboard:** Statistik dan ringkasan proyek serta tugas yang sedang berlangsung.
- **Autentikasi Pengguna:** Login, registrasi, dan pengelolaan anggota tim.

## Teknologi yang Digunakan
- **Framework:** Laravel 11
- **Database:** MySQL
- **Front-End:** Blade Template, Tailwind CSS
- **Autentikasi:** Laravel Breeze

## Struktur Database
### Tabel Utama
1. **Users**
   - `id` (Primary Key, Auto Increment)
   - `name` (varchar, 255)
   - `email` (varchar, 255, unique)
   - `password` (varchar, 255)

2. **Projects**
   - `id` (Primary Key, Auto Increment)
   - `name` (varchar, 255)
   - `description` (text)
   - `created_by` (Foreign Key, Users.id)

3. **Tasks**
   - `id` (Primary Key, Auto Increment)
   - `title` (varchar, 255)
   - `description` (text)
   - `status` (enum: 'pending', 'in_progress', 'completed')
   - `project_id` (Foreign Key, Projects.id)
   - `assigned_to` (Foreign Key, Users.id)

4. **Comments**
   - `id` (Primary Key, Auto Increment)
   - `content` (text)
   - `task_id` (Foreign Key, Tasks.id)
   - `user_id` (Foreign Key, Users.id)

5. **Group Members**
   - `id` (Primary Key, Auto Increment)
   - `project_id` (Foreign Key, Projects.id)
   - `user_id` (Foreign Key, Users.id)

## Instalasi
1. Clone repository ini:
   ```bash
   git clone https://github.com/Varel05/TaskNest.git
   ```
2. Masuk ke direktori proyek:
   ```bash
   cd TaskNest
   ```
3. Install dependencies:
   ```bash
   composer install
   npm install
   ```
4. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
5. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```
6. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```
7. Jalankan aplikasi:
   ```bash
   php artisan serve
   ```
8. Akses aplikasi di [http://localhost:8000](http://localhost:8000).

## Penggunaan
- **Ketua Tim:** Membuat proyek dan menambahkan anggota.
- **Anggota Tim:** Melihat tugas yang ditugaskan, memperbarui status tugas, dan memberikan komentar.

## Kontribusi
1. Fork repository ini.
2. Buat branch fitur baru:
   ```bash
   git checkout -b fitur-baru
   ```
3. Commit perubahan Anda:
   ```bash
   git commit -m 'Menambahkan fitur baru'
   ```
4. Push ke branch Anda:
   ```bash
   git push origin fitur-baru
   ```
5. Buat pull request.

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE).

## Kontak
Jika Anda memiliki pertanyaan atau saran, silakan hubungi:
- Nama: [Varel Deva Dewangga]
- Email: [vareldeva75@gmail.com]
- GitHub: [Varel05](https://github.com/Varel05)

- Nama: [Edwin Pavel Ekapagliuca]
- Email: [edwinpaveleka@gmail.com]
- GitHub: [Pavelekaa11](https://github.com/Pavelekaa11)

## Kontributor
- **Varel Deva Dewangga** - [GitHub Profile 1](https://github.com/Varel05)
- **Edwin Pavel Ekapagliuca** - [GitHub Profile 2](https://github.com/Pavelekaa11)

