# EatTrack

## Deskripsi
EatTrack merupakan sebuah sistem reservasi tempat makan berbasis web yang berfokus untuk memberikan informasi tempat makan terdekat di lokasi anda. Informasi yang diberikan berupa jam buka tempat makan, foto tempat makan, list menunya, dan sebagainya. Tidak hanya memberikan informasi, anda juga dapat melakukan reservasi tempat makan sesuai pilihan anda. Diharapkan dengan adanya sistem ini, akan membuat pengguna dapat lebih mudah mencari informasi terkait tempat makan terdekat di lokasi anda berada.

## Team Roles & Responsibilities
Ketua: Azizurrifki (Backend) <br>
Anggota 1: Muhammad Tegar Bijanta (UI/UX Designer, Front End)<br>
Anggota 2: Muhammad Izzul Islam (Front End)

## Alamat
[http://localhost]

## Menu Utama
```
- All Role
    - Landing Page (index.php)
- Customer
    - Registrasi akun
    - Login
        - Beranda
        - Melihat Detail Restoran dan booking
        - Laporan Bug
        - Menampilkan map dan menelusuri restoran dari map
        - Mengbubah dan meilhat profil customer
        - Melihat tawaran promo
        - Melihat dan membatalkan reservasi 
- Owner
    - Registrasi akun
    - Login
        - Dashboard Owner
        - Mengelola Menu
        - Konfirmasi Reservasi
        - Mengelola profil Owner
        - Mengbubah dan meilhat profil owner
        - Mengelola promo
- Admin
    - Login
        - Dashboard admin
        - Mengelola User
        - Melihat Laporan bug dari customer
```

## SiteMap
```text
EatTrack
│
├── views
|   ├── Home (index.blade.php)
|   ├── Login (login_page.blade.php)
|   ├── Register (register_page.blade.php)
|   ├── Register Customer (register_as_customer.blade.php)
|   ├── Register Owner (register_as_owner.blade.php)
|   ├── Forgot Password (forgot_password.blade.php)
|   │
|   ├── Customer
|   │   ├── Beranda Customer (Beranda_Customer.blade.php)
|   │   ├── Detail Restoran (DetailResto.blade.php)
|   │   ├── Reservasi (Reservasi.blade.php)
|   │   ├── Promo (Promo.blade.php)
|   │   ├── Map Lokasi (Map.blade.php)
|   │   ├── Laporan (Laporan.blade.php)
|   │   └── Profil Customer (Profile_customer.blade.php)
|   │
|   ├── Owner
|   │   ├── Beranda Owner (beranda_owner.blade.php)
|   │   ├── Kelola Menu (kelola_menu.blade.php)
|   │   ├── Tambah Promo (tambahpromo_owner.blade.php)
|   │   ├── Promo Owner (promo_owner.blade.php)
|   │   ├── Konfirmasi Booking (konfirmasi_book.blade.php)
|   │   └── Profil Owner (profil_owner.blade.php)
|   │
|   ├── Admin
|   │   ├── Beranda Admin (beranda_admin.blade.php)
|   │   ├── Kelola User (kelola_user.blade.php)
|   │   └── Laporan (laporan.blade.php)
|   │
|   └── Components
|       ├── Navbar
|       ├── Sidebar
|       └── Sidebar Admin
|
├── Controllers
|   ├── Controller untuk admin (AdminController.php)
|   ├── Controller untuk autentikasi (AuthController.php)
|   ├── Controller untuk customer (CustomerController.php)
|   └── Controller untuk owner (OwnerController.php)
|
└── Models
    ├── Model untuk klaim promo (ClaimedPromo.php)
    ├── Model untuk menu dari restoran (Menu.php)
    ├── Model untuk promo (Promo.php)
    ├── Model untuk laporan bug (Report.php)
    ├── Model untuk reservasi meja (Reservation.php)
    ├── Model untuk restoran (Restaurant.php)
    ├── Model untuk review (Review.php)
    ├── Model untuk meja yang di reservasi (Table.php)
    └── Model untuk user/pengguna (User.php)
```

## TechStack
- Frontend : HTML, JavaScript, CSS Tailwind
- Backend : Laravel
- Database : MySQL
- Local Server : XAMPP
- Design Support : Figma
- Version Control : Git / Github

## Requirement
Untuk menggunakan EatTrack ini, anda harus menginstall dan konfigurasi berikut:
- PHP
- MySQL/MariaDB

## Screenshot Aplikasi

### Landing Page
<img width="496" height="508" alt="Landing-page" src="https://github.com/user-attachments/assets/2263dd46-b510-4084-95ef-f074d487df80" />

### Login
<img width="605" height="432" alt="Login" src="https://github.com/user-attachments/assets/7395896f-d29e-43ec-beee-2743cd9215d6" />

### Dashboard Owner
<img width="668" height="476" alt="Dashboard-owner" src="https://github.com/user-attachments/assets/53511af2-568f-4516-9ca9-a7bf127e1ab6" />

## Bug Log

### Bug 1 — API restaurants & reservations error (500)
1) **Gejala**: Endpoint `GET /api/restaurants` & `/api/reservations` selalu return 500.
2) **Langkah reproduksi**: Login sebagai customer → hit endpoint `/api/restaurants` → error `Class "RestaurantResource" not found`.
3) **Hipotesis penyebab**: Namespace class pakai `Resources` (dengan "s"), tapi folder fisiknya `Resource` (tanpa "s") — mismatch PSR-4 autoload.
4) **Fix**: Rename folder `app/Http/Resource/` → `app/Http/Resources/`, lalu `composer dump-autoload`.
5) **Bukti**: 

### Bug 2 — Halaman Detail Restoran crash
1) **Gejala**: Klik kartu restoran di Beranda/Map menghasilkan error `Undefined variable $resto_id`.
2) **Langkah reproduksi**: Login customer → klik restoran → redirect `/katalog/{id}` → error.
3) **Hipotesis penyebab**: Method `detail_resto()` tidak punya parameter `$resto_id` di signature, padahal dipakai di body.
4) **Fix**: Ubah signature jadi `detail_resto(Request $request, $resto_id)`.
5) **Bukti**: 

### Bug 3 — Update profil restoran (Owner) tidak tersimpan
1) **Gejala**: Klik simpan di form Profil Owner malah munculin halaman `dd()` debug.
2) **Langkah reproduksi**: Login owner → buka `/profil_owner` → ubah data → submit → muncul dump variabel.
3) **Hipotesis penyebab**: Ada baris `dd($request->maps_link, $request->name, $request->address);` yang lupa dihapus di awal method.
4) **Fix**: Hapus baris `dd(...)` tersebut.
5) **Bukti**: 

### Bug 4 — Dua customer bisa booking meja & jam yang sama (race condition)
1) **Gejala**: Dua reservasi `pending`/`confirmed` muncul untuk meja, tanggal, dan jam yang sama.
2) **Langkah reproduksi**: Dua user submit reservasi meja & jam sama hampir bersamaan → keduanya berhasil tersimpan.
3) **Hipotesis penyebab**: `checkConflict()` dan `store()` jalan terpisah tanpa transaction/locking — classic check-then-act race condition, gak ada unique constraint di DB.
4) **Fix**: Bungkus dalam `DB::transaction()` + `lockForUpdate()`, tambah migration unique constraint (`table_id`, `date`, `time`).
5) **Bukti**: 

### Bug 5 — Reservasi bisa dibuat di luar jam operasional
1) **Gejala**: Customer bisa booking di luar `open_time`/`close_time` restoran (misal jam 2 pagi).
2) **Langkah reproduksi**: Buka restoran buka jam 08:00–22:00 → isi reservasi jam 02:00 → submit berhasil tanpa error.
3) **Hipotesis penyebab**: `StoreReservationRequest` cuma validasi `date` & `time` ada isinya, gak dibandingkan ke `open_time`/`close_time`.
4) **Fix**: Tambah custom validation cek `time` vs `open_time`/`close_time` restoran sebelum simpan.
5) **Bukti**: 

## AI Usage Statement (wajib)
1) **Tool**: Claude (Anthropic) dalam mode chat.

2) **Untuk apa**: Membantu menelusuri source code Laravel dan menganalisis kemungkinan bug pada alur reservasi, validasi data, serta relasi antar komponen.

3) **2 prompt utama**:
   - "Analisis kemungkinan race condition atau inkonsistensi data pada proses reservasi ketika banyak request masuk bersamaan."
   - "Periksa apakah ada validasi yang terlewat atau alur yang dapat menyebabkan data tidak konsisten."

4) **Bagian output AI yang dipakai**: Referensi analisis terkait kemungkinan konflik reservasi dan pemeriksaan validasi pada beberapa fitur.

5) **Bagian yang saya ubah + alasan**: Hasil analisis AI saya verifikasi kembali secara manual pada source code dan disesuaikan dengan struktur project agar sesuai dengan implementasi sebenarnya.
