# EatTrack
## Deskripsi
EatTrack merupakan sebuah sistem reservasi tempat makan berbasi web yang berfokus untuk memberikan informasi tempat makan terdekat di lokasi anda. Informasi yang diberikan berupa jam buka tempat makan, foto tempat makan, list menunya, dan sebagainya. Tidak hanya memberikan informasi, anda juga dapat melakukan reservasi tempat makan sesuai pilihan anda. Diharapkan dengan adanya sistem ini, akan membuat pengguna dapat lebih mudah mencari informasi terkait tempat makan terdekat di lokasi anda berada.

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
├── Models
|   ├── Model untuk klaim promo (ClaimedPromo.php)
|   ├── Model untuk menu dari restoran (Menu.php)
|   ├── Model untuk promo (Promo.php)
|   ├── Model untuk laporan bug (Report.php)
|   ├── Model untuk reservasi meja (Reservation.php)
|   ├── Model untuk restoran (Restaurant.php)
|   ├── Model untuk review (Review.php)
|   ├── Model untuk meja yang di reservasi (Table.php)
|   └── Model untuk user/pengguna (User.php)
|
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
