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
  
## Struktur Folder Project

```
lab7_php_ci/
├── app/
│   ├── Cells/
│   │   └── ArtikelTerkini.php
│   ├── Config/
│   │   ├── Filters.php
│   │   └── Routes.php
│   ├── Controllers/
│   │   ├── Artikel.php
│   │   ├── Page.php
│   │   └── User.php
│   ├── Filters/
│   │   └── Auth.php
│   ├── Models/
│   │   ├── ArtikelModel.php
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
└──
```

## Praktikum yang Telah Diselesaikan

### Praktikum 1: PHP Framework (CodeIgniter 4)
- Memahami konsep MVC
- Routing dan Controller
- Template partial (`header.php` & `footer.php`)

### Praktikum 2: Framework Lanjutan (CRUD)
- Model `ArtikelModel`
- CRUD Artikel (Create, Read, Update, Delete)
- Halaman admin sederhana

### Praktikum 3: View Layout dan View Cell
- Menggunakan **View Layout** (`layout/main.php`)
- Implementasi **View Cell** untuk "Artikel Terkini"
- Sidebar modular

### Praktikum 4: Framework Lanjutan (Modul Login)
- Sistem Login dengan `UserModel`
- Auth Filter
- Proteksi halaman admin
- Fitur Logout


### Screenshot
<img width="1366" height="728" alt="Image" src="https://github.com/user-attachments/assets/150c1b3c-b174-4013-9478-9a70c207fe55" />
