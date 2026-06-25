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

| Landing Page | Dashboard Owner | Login |
|---|---|---|
| ![Landing Page](<img width="496" height="508" alt="Landing-page" src="https://github.com/user-attachments/assets/bc8bf69c-eb81-440d-88ad-c1657f2c4721" />
) | ![Dashboard Owner](<img width="668" height="476" alt="Dashboard-owner" src="https://github.com/user-attachments/assets/3ac2d812-88e6-4dad-9077-89f81ed9bde4" />
) | ![Login](<img width="605" height="432" alt="Login" src="https://github.com/user-attachments/assets/5ccb5c1c-5096-4a9f-8a32-bcf12e0e73e8" />
) |

## Bug Log

### Bug 1 — API restaurants & reservations error (500)
1) **Gejala**: Endpoint `GET /api/restaurants` dan `GET /api/reservations` selalu return 500 Internal Server Error, padahal route dan controller sudah benar.
2) **Langkah reproduksi**: Login sebagai customer → hit endpoint `/api/restaurants` atau `/api/reservations` → server melempar error `Class "App\Http\Resources\RestaurantResource" not found`.
3) **Hipotesis penyebab**: Class `RestaurantResource` dan `ReservationResource` mendeklarasikan `namespace App\Http\Resources;` (dengan "s"), tapi file fisiknya disimpan di folder `app/Http/Resource/` (tanpa "s"). Karena PSR-4 autoload Composer memetakan namespace ke path folder secara 1:1, class tidak pernah ditemukan saat di-autoload.
4) **Fix (apa yang diubah)**: Pindahkan/rename folder `app/Http/Resource/` menjadi `app/Http/Resources/` agar konsisten dengan namespace yang dideklarasikan di kedua file (`RestaurantResource.php`, `ReservationResource.php`), lalu jalankan `composer dump-autoload`.
5) **Bukti**: `app/Http/Resource/RestaurantResource.php` dan `app/Http/Resource/ReservationResource.php` (baris 3) — `namespace App\Http\Resources;`, sementara folder fisiknya `app/Http/Resource/`.

### Bug 2 — Halaman Detail Restoran crash
1) **Gejala**: Mengklik kartu restoran di Beranda Customer atau di Map (menuju `/katalog/{id}`) menghasilkan error `Undefined variable $resto_id`, halaman detail restoran gagal dimuat.
2) **Langkah reproduksi**: Login sebagai customer → buka Beranda atau Map → klik salah satu restoran → diarahkan ke `/katalog/{id}` → error muncul.
3) **Hipotesis penyebab**: Route `Route::get('/katalog/{resto_id}', ...)` mengirim parameter `resto_id`, tapi method `detail_resto(Request $request)` di `CustomerController` tidak mendeklarasikan parameter `$resto_id` pada signature-nya, sementara di dalam body method tetap memakai variabel `$resto_id` yang tidak pernah didefinisikan.
4) **Fix (apa yang diubah)**: Ubah signature method menjadi `detail_resto(Request $request, $resto_id)` sehingga parameter route ikut terinjeksi, lalu query `Restaurant::where('id', $resto_id)` bisa berjalan sesuai harapan.
5) **Bukti**: `app/Http/Controllers/CustomerController.php`, method `detail_resto()` — signature method tidak punya parameter `$resto_id` walau dipakai di dalam body.

### Bug 3 — Update profil restoran (Owner) tidak pernah tersimpan
1) **Gejala**: Saat owner mengisi form "Profil Owner" dan klik simpan, halaman malah menampilkan halaman dump variabel (Laravel `dd()`) berisi `maps_link`, `name`, dan `address`, alih-alih menyimpan perubahan dan redirect ke halaman profil.
2) **Langkah reproduksi**: Login sebagai owner → buka `/profil_owner` → ubah data restoran → submit form → muncul halaman `dd()` debug, data tidak tersimpan.
3) **Hipotesis penyebab**: Ada baris debug `dd($request->maps_link, $request->name, $request->address);` yang lupa dihapus di awal method `updateProfil()`, sehingga eksekusi PHP langsung berhenti sebelum sampai ke proses validasi dan `$restaurant->update(...)`.
4) **Fix (apa yang diubah)**: Hapus baris `dd(...)` tersebut dari `OwnerController@updateProfil` agar request lanjut ke validasi dan proses update data restoran seperti seharusnya.
5) **Bukti**: `app/Http/Controllers/OwnerController.php`, method `updateProfil()` — baris debug `dd($request->maps_link, $request->name, $request->address);` ada tepat di awal method, sebelum proses validasi dan update.

### Bug 4 — Dua customer bisa booking meja & jam yang sama (race condition)
1) **Gejala**: Sesekali dua reservasi berstatus `pending`/`confirmed` muncul untuk `table_id`, `date`, dan `time` yang sama persis — meja jadi "dobel pesan" padahal seharusnya sudah ditolak oleh sistem.
2) **Langkah reproduksi**: Dua user berbeda membuka form reservasi untuk meja & jam yang sama, lalu submit hampir bersamaan (selisih sangat singkat) → keduanya berhasil masuk sebagai reservasi terpisah untuk meja yang sama.
3) **Hipotesis penyebab**: `storeReservasi()` melakukan cek konflik (`checkConflict()` → `SELECT ... exists()`) dan proses simpan (`store()` → `create()`) sebagai dua operasi terpisah tanpa transaksi/locking. Ini classic *check-then-act race condition*: request A dan B bisa sama-sama lolos `checkConflict()` sebelum salah satu dari mereka sempat `INSERT`. Di level database juga tidak ada `unique constraint` pada kombinasi `table_id + date + time`, cuma index biasa (`reservations_conflict_check`), jadi DB tidak menolak data duplikat.
4) **Fix (apa yang diubah)**: Bungkus `checkConflict()` + `store()` dalam satu `DB::transaction()` memakai `lockForUpdate()` saat query existing reservation untuk `table_id` tersebut, sehingga request kedua menunggu request pertama selesai sebelum ikut mengecek. Sebagai pengaman tambahan, tambahkan migration baru untuk `unique constraint` pada kombinasi (`table_id`, `date`, `time`) dengan kondisi status aktif, supaya tetap aman walau ada race condition di level aplikasi.
5) **Bukti**: `app/Services/ReservationService.php` (`checkConflict()`, `store()`) dipanggil terpisah di `CustomerController::storeReservasi()`; migration `2026_06_04_080421_add_index_to_reservations_table.php` hanya membuat index, bukan unique constraint.

### Bug 5 — Reservasi bisa dibuat di luar jam operasional restoran
1) **Gejala**: Customer tetap bisa berhasil membuat reservasi untuk jam ketika restoran sudah tutup (misalnya jam 2 pagi), padahal tabel `restaurants` punya kolom `open_time` dan `close_time`.
2) **Langkah reproduksi**: Login sebagai customer → buka detail restoran yang `open_time`-nya jam 08:00 dan `close_time` jam 22:00 → isi form reservasi dengan jam 02:00 → submit → reservasi berhasil tersimpan tanpa error.
3) **Hipotesis penyebab**: `StoreReservationRequest::rules()` hanya memvalidasi `date` (harus `after_or_equal:today`) dan `time` (cuma `required`, tanpa format/range), tidak pernah membandingkan `time` yang diinput dengan `open_time`/`close_time` milik `restaurant_id` yang dipilih.
4) **Fix (apa yang diubah)**: Tambahkan custom validation rule (lewat `withValidator()` di `StoreReservationRequest` atau cek tambahan di `ReservationService::checkConflict()`) yang mengambil `Restaurant::find($request->restaurant_id)` lalu memastikan `time` berada di antara `open_time` dan `close_time` restoran tersebut sebelum reservasi disimpan; tampilkan pesan error "Restoran tutup pada jam yang dipilih" jika gagal.
5) **Bukti**: `app/Http/Requests/StoreReservationRequest.php` (`rules()` tidak menyentuh `open_time`/`close_time`); kolom `open_time`/`close_time` ada di `database/migrations/2026_05_29_061746_create_restaurants_table.php` tapi tidak pernah dipakai saat validasi reservasi.

## AI Usage Statement (wajib)
1) **Tool**: Claude (Anthropic) dalam mode chat.

2) **Untuk apa**: Membantu menelusuri source code Laravel dan menganalisis kemungkinan bug pada alur reservasi, validasi data, serta relasi antar komponen.

3) **2 prompt utama**:
   - "Analisis kemungkinan race condition atau inkonsistensi data pada proses reservasi ketika banyak request masuk bersamaan."
   - "Periksa apakah ada validasi yang terlewat atau alur yang dapat menyebabkan data tidak konsisten."

4) **Bagian output AI yang dipakai**: Referensi analisis terkait kemungkinan konflik reservasi dan pemeriksaan validasi pada beberapa fitur.

5) **Bagian yang saya ubah + alasan**: Hasil analisis AI saya verifikasi kembali secara manual pada source code dan disesuaikan dengan struktur project agar sesuai dengan implementasi sebenarnya.
