# Analisis Tugas Basis Data: Tabel Produk (Faiq Akhmad)

## 📝 Soal No. 1: Analisis Atribut pada Tabel Produk

Tabel Produk adalah entitas inti dalam sistem e-commerce. Atribut-atributnya dirancang untuk mendefinisikan dan mengidentifikasi setiap barang yang dijual.

| Atribut | Peran (Keterangan) | Tipe Data yang Mungkin | Kunci |
| :--- | :--- | :--- | :--- |
| **`Product_Id`** | Pengenal unik untuk setiap produk. | Integer / Varchar | **Primary Key (PK)** |
| **`Brand_Id`** | Mengidentifikasi merek produk. | Integer / Varchar | **Foreign Key (FK)** ke Tabel Brand |
| **`Category_Id`** | Mengidentifikasi kategori produk (misalnya, Elektronik, Pakaian). | Integer / Varchar | **Foreign Key (FK)** ke Tabel Kategori |
| **`Nama Produk`** | Nama lengkap produk yang dijual. | Varchar (50-255) | Non-Key |
| **`Deskripsi`** | Detail atau penjelasan panjang mengenai fitur dan spesifikasi produk. | Text | Non-Key |
| **`Created`** | Tanggal dan waktu produk pertama kali dicatat dalam sistem. | Datetime/Timestamp | Non-Key |
| **`Updated`** | Tanggal dan waktu terakhir informasi produk diperbarui. | Datetime/Timestamp | Non-Key |
| **`Status`** | Indikator ketersediaan (Aktif/Nonaktif/Draft). | Boolean / Varchar | Non-Key |

---

## 🔗 Soal No. 2: Relasi Tabel Produk dengan Tabel Teman Lain

Tabel Produk (`Product_Id`) merupakan pusat dari banyak relasi, menghubungkan data dasar (Brand, Category) dengan data transaksional (Keranjang, Pesanan) dan data pengguna (Review, Wishlist).

### 1. Relasi One-to-Many (1:N)

#### A. Produk Merujuk ke Data Dasar (Produk menggunakan FK)

| Tabel Teman | Kunci Penghubung | Jenis Relasi | Keterangan |
| :--- | :--- | :--- | :--- |
| **Tabel Brand** (Juniar Viki) | **`Brand_Id`** (FK di Produk) | 1 Brand memiliki N Produk | Tabel Produk mengambil `Brand_Id` sebagai Kunci Tamu. |
| **Tabel Kategori** (Naufal Fawwaz Ardiansyah) | **`Category_Id`** (FK di Produk) | 1 Kategori memiliki N Produk | Tabel Produk mengambil `Category_Id` sebagai Kunci Tamu. |

#### B. Data Transaksional & User Merujuk ke Produk (Tabel Teman menggunakan FK)

| Tabel Teman | Kunci Penghubung | Jenis Relasi | Keterangan |
| :--- | :--- | :--- | :--- |
| **Tabel Varian** (Moh. Arman Maulana) | **`Product_Id`** (FK di Varian) | 1 Produk memiliki N Varian | Produk dapat memiliki berbagai variasi (ukuran, warna, dsb.). |
| **Tabel Media** (Wylson Marcho Adelwin) | **`Product_Id`** (FK di Media) | 1 Produk memiliki N Media | Menyimpan banyak gambar atau video untuk satu produk. |
| **Tabel Review/Rating** (Haidar M. Fadhil) | **`Product_Id`** (FK di Review) | 1 Produk memiliki N Review | Setiap produk dapat diulas oleh banyak pengguna. |
| **Tabel Wishlist/Favorite** (Elitsa E. Nurcahyati) | **`Product_Id`** (FK di Wishlist) | 1 Produk ada di N Wishlist | Produk ditambahkan ke daftar keinginan banyak pengguna. |
| **Tabel Produk Popular** (M. Ilham Musyaffa) | **`Product_Id`** (FK di Produk Popular) | 1 Produk dapat dicatat N kali | Digunakan untuk mencatat popularitas produk. |

### 2. Relasi Many-to-Many (N:M)

Produk memiliki relasi N:M dengan entitas lain (seperti Keranjang atau Pesanan) melalui **Tabel Varian** dan tabel perantara lainnya (misalnya, Item Keranjang dan Item Pesanan).

* **Produk** ↔ **Keranjang**
    * **Jalur:** `Produk` (1:N) $\rightarrow$ `Varian` (1:N) $\rightarrow$ `Item Keranjang` (N:1) $\rightarrow$ `Keranjang`
    * **Tabel Terlibat:** **Tabel Item Keranjang** (Nicko Ikhwan Prayogi) menggunakan `Variant_Id` sebagai Foreign Key.

* **Produk** ↔ **Pesanan**
    * **Jalur:** `Produk` (1:N) $\rightarrow$ `Varian` (1:N) $\rightarrow$ `Item Pesanan` (N:1) $\rightarrow$ `Pesanan`
    * **Tabel Terlibat:** **Tabel Item Pesanan** (Riyan Zacki Saputra) menggunakan `Variant_Id` sebagai Foreign Key.