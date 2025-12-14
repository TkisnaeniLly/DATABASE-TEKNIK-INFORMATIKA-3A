# Analisis & Perancangan Tabel `Patner Company`

Dokumen ini menjelaskan perancangan tabel **Patner Company** yang berfungsi menyimpan data entitas eksternal yang bermitra dengan sistem *e-commerce* (Zalora-like), seperti penyedia logistik, pembayaran, dan *brand* produk.

---

## 1. Latar Belakang Perancangan Tabel

Dalam sistem *e-commerce*, banyak proses bisnis yang bergantung pada pihak ketiga. Tabel **`Patner Company`** dirancang untuk memusatkan data semua mitra ini. Pengelompokan ini menghindari redundansi data di tabel terpisah serta mempermudah pengelolaan data dan *branding* mitra.

* **Logistik:** Dibutuhkan jasa pengiriman eksternal (misalnya JNE, J&T).
* **Pembayaran:** Dibutuhkan bank atau *e-wallet* sebagai penyedia metode pembayaran (misalnya OVO, Kredivo).
* **Produk:** Produk disediakan oleh berbagai *Brand* (mitra) (misalnya Nike, H&M).

---

## 2. Struktur Tabel `Patner Company`

### Nama Tabel

`Patner Company`

### Atribut Tabel

| Nama Atribut | Keterangan |
| :--- | :--- |
| `Partner_Id` | Primary Key sebagai identitas unik perusahaan mitra. |
| `Name` | Nama resmi perusahaan mitra (contoh: "Levi's", "Bank Mandiri"). |
| `Logo_Url` | URL lokasi logo mitra untuk keperluan tampilan *website*. |
| `Type` | Kategori peran mitra (`Logistics`, `Payment`, `Brand`, `Marketing`). |

---

## 3. Relasi Tabel `Patner Company`

Tabel `Patner Company` berfungsi sebagai tabel master yang berelasi dengan tabel lain melalui tipe mitra (`Type`).

| Tabel Terkait | Jenis Relasi | Keterangan |
| :--- | :--- | :--- |
| **Produk** (Tabel 3) | 1 : N | Satu Partner (sebagai Brand) dapat memiliki banyak Produk. Relasi melalui `Brand_Id`. |
| **Metode Pembayaran** (Tabel 16) | 1 : N | Satu Partner (sebagai Payment Provider) dapat menyediakan banyak Metode Pembayaran. |
| **Jasa Pengiriman** (Tabel 17) | 1 : N | Satu Partner (sebagai Logistik) dapat menyediakan berbagai Service Pengiriman. |
| **Promo** (Tabel 21) | N : N | Promo dapat memiliki keterikatan eksklusif dengan Partner tertentu (misalnya Promo Bank X). |

---

## 4. Fungsi Tabel `Patner Company`

Tabel `Patner Company` berfungsi sebagai:

* Penyimpanan data identitas perusahaan mitra secara terpusat.
* Dasar untuk menampilkan logo dan nama *brand* atau penyedia layanan di halaman *e-commerce*.
* Penghubung utama ke data produk, pembayaran, dan pengiriman berdasarkan jenis mitra.

---

## 5. Analisis Normalisasi

### First Normal Form (1NF)

* Semua atribut bernilai atomik.
* Tidak terdapat atribut *multivalue*.
* Setiap *record* memiliki *primary key* (`Partner_Id`).

**Status: Memenuhi 1NF**

---

### Second Normal Form (2NF)

* *Primary key* terdiri dari satu atribut yaitu `Partner_Id`.
* Semua atribut non-key (`Name`, `Logo_Url`, `Type`) bergantung sepenuhnya pada `Partner_Id`.

**Status: Memenuhi 2NF**

---

### Third Normal Form (3NF)

* Tidak terdapat ketergantungan transitif.
* Setiap atribut non-key hanya bergantung langsung pada *primary key* (`Partner_Id`).

**Status: Memenuhi 3NF**

---

## Kesimpulan

Perancangan tabel **`Patner Company`** dengan pengelompokan berdasarkan `Type` menghasilkan struktur yang efisien dan mendukung kebutuhan sistem *e-commerce* untuk berinteraksi dengan berbagai pihak eksternal. Desain ini juga memenuhi kaidah normalisasi hingga Third Normal Form (3NF).
