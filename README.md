# Laravel User Role Management with Spatie

Aplikasi ini adalah sistem manajemen peran pengguna (User Role Management) berbasis Laravel menggunakan package **Spatie Laravel Permission**. Sistem ini memungkinkan pengelolaan data keuangan dengan alur kerja (workflow) dan akses yang diatur berdasarkan peran (role) pengguna: **Admin**, **Manager**, dan **Staff**.

---

## Fitur Utama

1. **Staff Workflow**:
   - Membuat, mengedit, dan menghapus laporan keuangan selama laporan belum disetujui oleh Admin.
   - Mengirim laporan keuangan ke Admin untuk disetujui.

2. **Admin Workflow**:
   - Menyetujui atau menolak laporan keuangan yang dikirim oleh Staff.
   - Mengedit data laporan keuangan yang dikirimkan oleh Staff.

3. **Manager Workflow**:
   - Melihat laporan keuangan yang dibuat oleh Staff.
   - Tidak memiliki akses untuk mengedit atau menghapus data.

---

## User Role dan Hak Akses

### 1. Admin
- Akses penuh terhadap sistem.
- Hak untuk:
  - Membuat, mengedit, dan menghapus data keuangan.
  - Melihat laporan keuangan secara menyeluruh.
  - Menyetujui atau menolak laporan dari Staff.

### 2. Manager
- Hak untuk:
  - Melihat laporan keuangan yang dibuat oleh Staff.
- Batasan:
  - Tidak dapat mengedit atau menghapus data keuangan.
  - Tidak dapat membuat laporan baru.

### 3. Staff
- Hak untuk:
  - Menginput data laporan keuangan.
  - Mengedit atau menghapus data keuangan selama laporan belum disetujui oleh Admin.
- Batasan:
  - Tidak dapat melihat laporan secara menyeluruh.
  - Tidak memiliki akses untuk menyetujui atau menolak laporan.

---

## Workflow Aplikasi

1. **Staff**:
   - Membuat laporan keuangan dan mengirimkannya ke Admin.
   - Bisa mengedit atau menghapus laporan selama laporan belum disetujui.

2. **Admin**:
   - Meninjau laporan keuangan yang dikirimkan oleh Staff.
   - Menyetujui atau menolak laporan keuangan.
   - Mengedit laporan keuangan bila diperlukan.

3. **Manager**:
   - Melihat laporan keuangan yang telah dibuat oleh Staff.

---

## Teknologi yang Digunakan

- **Laravel**: Framework utama untuk membangun aplikasi.
- **Spatie Laravel Permission**: Mengelola peran dan izin pengguna.
- **MySQL**: Basis data untuk menyimpan data keuangan.
- **Bootstrap/TailwindCSS**: (opsional) Untuk antarmuka pengguna (UI).

---

## Cara Instalasi

1. **Clone repository**:
   ```bash
   git clone https://github.com/username/repository-name.git
   cd repository-name
