# Praktikum 1-14 Pemrograman Web 2

**Nama**  : Ibnu Nazhif Alamsyah  
**NIM**   : 312410094  

---

### Deskripsi
Modul ini membangun sistem **Login** menggunakan **CodeIgniter 4** lengkap dengan:
- Auth Filter
- Session Management
- Password Hashing (`password_hash` & `password_verify`)
- Database Seeder
- Proteksi halaman Admin

---
  
**Teknologi yang Digunakan:**
- **Backend**: CodeIgniter 4 (PHP Framework)
- **Frontend**: Vue.js 3 (CDN) + Vue Router + Axios
- **Database**: MySQL / phpMyAdmin
- **Server**: XAMPP

---


## 🚀 Cara Instalasi

### 1. Clone Repository
```bash
git clone https://github.com/<username>/<nama-repo>.git
cd <nama-repo>
```

### 2. Konfigurasi Environment
```bash
# Salin file env
cp env .env

# Aktifkan mode development
# Edit .env, ubah:
CI_ENVIRONMENT = development
```

### 3. Konfigurasi Database
Edit file `.env`:
```
database.default.hostname = localhost
database.default.database = lab_ci4
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

### 4. Buat Database & Jalankan Migrasi
```sql
CREATE DATABASE lab_ci4;
```
```bash
php spark db:seed UserSeeder
```

### 5. Jalankan Server
```bash
php spark serve
```
Buka browser: `http://localhost:8080`

---

## Struktur Folder Project

```
lab7_php_ci/
├── app/
│   ├── Cells/
│   │   └── ArtikelTerkini.php
│   ├── Config/
│   │   ├── Filters.php
│   │   ├── Paths.php
│   │   └── Routes.php           
│   ├── Controllers/
│   │   ├── Api/                
│   │   │   ├── Auth.php        
│   │   │   └── Post.php
│   │   ├── AjaxController.php
│   │   ├── Artikel.php
│   │   ├── Page.php
│   │   ├── Post.php
│   │   └── User.php
│   ├── Filters/
│   │   ├── Auth.php
│   │   └── ApiAuthFilter.php
│   ├── Models/
│   │   ├── ArtikelModel.php
│   │   ├── KategoriModel.php
│   │   └── UserModel.php
│   ├── Views/
│   │   ├── artikel/
│   │   │   ├── index.php
│   │   │   ├── detail.php
│   │   │   └── admin_index.php
│   │   ├── components/
│   │   │   └── artikel_terkini.php
│   │   ├── layout/
│   │   │   └── main.php
│   │   ├── page/
│   │   │   ├── about.php
│   │   │   ├── contact.php
│   │   │   └── faqs.php
│   │   ├── template/
│   │   │   ├── header.php
│   │   │   └── footer.php
│   │   ├── user/
│   │   │   └── login.php
│   │   └── home.php
│   └── (folder lain bawaan CI4: Database, Helpers, dll)
├── public/
│   ├── assets/
│   │   │── js/
│   │   │   └──jquery-3.6.0.min.js
│   └── index.php
├── writable/
├── vendor/                    
├── spark
├── .env
└── composer.json
└──
```

```
lab8_vuejs/
├── index.html                   
├── assets/
│   ├── css/
│   │   └── style.css            
│   └── js/
│       ├── app.js               
│       └── components/
│           ├── Home.js
│           ├── Artikel.js
│           ├── Login.js         
│           └── About.js         
└──
```

## Praktikum yang Telah Diselesaikan

### Praktikum 1: PHP Framework (CodeIgniter 4)
- Memahami konsep MVC
- Routing dan Controller
- Template partial (`header.php` & `footer.php`)

### Praktikum 2: Framework Lanjutan (CRUD)

**Skema Database:**
```sql
CREATE TABLE artikel (
    id      INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul   VARCHAR(200) NOT NULL,
    isi     TEXT,
    gambar  VARCHAR(200),
    status  TINYINT(1) DEFAULT 0,
    slug    VARCHAR(200)
);
```

- Model `ArtikelModel`
- CRUD Artikel (Create, Read, Update, Delete)
- Halaman admin sederhana

### Praktikum 3: View Layout dan View Cell
- Menggunakan **View Layout** (`layout/main.php`)
- Implementasi **View Cell** untuk "Artikel Terkini"
- Sidebar modular

### Praktikum 4: Framework Lanjutan (Modul Login)

**Alur Login:**
```
Akses /admin → Filter cek session → Belum login → Redirect /user/login
                                  → Sudah login → Lanjut ke Controller
```

- Sistem Login dengan `UserModel`
- Auth Filter
- Proteksi halaman admin
- Fitur Logout

### Praktikum 5 – Pagination dan Pencarian

**Implementasi Kunci:**
```php
// Pagination + Search dalam satu method
$artikel = $model->like('judul', $q)->paginate(10);
$pager   = $model->pager;
```

**Fitur:**
- Pagination: batasi tampilan pakai paginate(10), tampilkan navigasi pakai $pager->links()
- Pencarian: form GET dengan ->like('judul', $q), dan $pager->only(['q']) agar kata kunci tidak hilang saat ganti halaman

### Praktikum 6 – Upload File Gambar

**Diagram Relasi:**
```
kategori (1) ──────── (Many) artikel
id_kategori (PK)      id_kategori (FK)
```
- Tambahkan enctype="multipart/form-data" di form dan <input type="file">
- Di controller pakai getFile('gambar')->move(ROOTPATH . 'public/gambar'), nama file disimpan ke database

### Praktikum 7 – Relasi Tabel & Query Builder
- Buat tabel kategori, tambahkan kolom id_kategori sebagai foreign key di tabel artikel
- Buat KategoriModel, tambahkan method JOIN di ArtikelModel, update controller & view untuk filter kategori + dropdown pilih kategori saat tambah/edit artikel

### Praktikum 8: AJAX dengan jQuery
- Implementasi AJAX CRUD menggunakan jQuery
- Fungsi loadData(), addData(), editData(), deleteData()
- Dynamic table tanpa reload halaman
- JSON response dari Controller

### Praktikum 9: AJAX Pagination & Search
- Kombinasi Pagination + Pencarian dengan AJAX
- Search form real-time
- Pagination links dengan AJAX
- Filter data tanpa me-refresh halaman

### Praktikum 10: RESTful API

**Endpoint API:**

| Method | URL | Fungsi |
|--------|-----|--------|
| GET | `/post` | Ambil semua artikel |
| GET | `/post/{id}` | Ambil artikel by ID |
| POST | `/post` | Tambah artikel baru |
| PUT | `/post/{id}` | Update artikel |
| DELETE | `/post/{id}` | Hapus artikel |

Routing cukup dengan satu baris:
```php
$routes->resource("post");
```

- Membuat Resource Controller (Post.php)
- Full CRUD menggunakan HTTP Method (GET, POST, PUT, DELETE)
- JSON Response dengan ResponseTrait
- Testing API menggunakan Postman

### Praktikum 11: VueJS 3 (Frontend)
- Frontend SPA dengan VueJS 3 (CDN)
- Integrasi dengan REST API Backend
- CRUD menggunakan Axios
- Modal form, reactive data, dan event handling

### Praktikum 12: VueJS Komponen dan Routing (Single Page Application)

**Struktur Komponen:**
```
index.html
└── #app
    ├── <nav> (router-link)
    └── <router-view>
        ├── Home.js     → path: "/"
        ├── Artikel.js  → path: "/artikel"
        └── About.js    → path: "/about"
```

- Pembuatan Komponen Modular (Home.js, Artikel.js)
- Implementasi Vue Router menggunakan CDN (vue-router@4)
- Client-Side Routing dengan createWebHashHistory()
- Navigasi Dinamis menggunakan <router-link> dan <router-view>
- Struktur Folder yang lebih modular (assets/js/components/)
- CSS Enhancement untuk tampilan navigasi dan halaman


### Praktikum 13: VueJS Autentikasi dan Navigation Guards (SPA Security)

**Alur Autentikasi:**
```
Login → Terima Token → Simpan di localStorage
     → Akses /artikel → Navigation Guard cek isLoggedIn
                       → Belum login → Redirect /login
```

- Client-Side Security menggunakan router.beforeEach()
- Membuat Komponen Login (Login.js)
- Integrasi API Login dari Backend CodeIgniter 4
- Proteksi Rute dengan meta: { requiresAuth: true }
- Dynamic Navigation (Login / Logout otomatis)
- Penyimpanan Status Login menggunakan localStorage


### Praktikum 14: Keamanan API, Autentikasi Token, dan Axios Interceptors

**Alur Autentikasi:**
```
Login → Terima Token → Simpan di localStorage
     → Akses /artikel → Navigation Guard cek isLoggedIn
                       → Belum login → Redirect /login
```

- Server-Side Security menggunakan Filter di CodeIgniter 4 (ApiAuthFilter)
- Token-Based Authentication (Authorization: Bearer <token>)
- Axios Interceptors (Request & Response) untuk menyuntikkan token secara otomatis
- Proteksi Endpoint API (POST, PUT, DELETE)
- Pengujian Keamanan menggunakan Postman (tanpa token → 401 Unauthorized)
- Integrasi penuh antara Frontend VueJS dan Backend CI4

## 🗄️ Skema Database Lengkap

```sql
-- Tabel Artikel
CREATE TABLE artikel (
    id           INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul        VARCHAR(200) NOT NULL,
    isi          TEXT,
    gambar       VARCHAR(200),
    status       TINYINT(1) DEFAULT 0,
    slug         VARCHAR(200),
    id_kategori  INT(11),
    CONSTRAINT fk_kategori_artikel FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori)
);

-- Tabel Kategori
CREATE TABLE kategori (
    id_kategori   INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL,
    slug_kategori VARCHAR(100)
);

-- Tabel User
CREATE TABLE user (
    id           INT(11) AUTO_INCREMENT PRIMARY KEY,
    username     VARCHAR(200) NOT NULL,
    useremail    VARCHAR(200),
    userpassword VARCHAR(200)
);
```

---


## Cara Menjalankan

### Backend
```bash
cd C:\xampp\htdocs\lab7_php_ci
C:\xampp\php\php.exe spark serve
Akses: http://localhost:8080
```

```
### Frontend
Buka langsung di browser: http://localhost/lab8_vuejs

```

### Screenshot
<img width="1366" height="728" alt="Image" src="https://github.com/user-attachments/assets/150c1b3c-b174-4013-9478-9a70c207fe55" />
