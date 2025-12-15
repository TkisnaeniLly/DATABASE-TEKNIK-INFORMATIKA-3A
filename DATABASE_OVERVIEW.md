
# DATABASE OVERVIEW – E-COMMERCE

**Gambaran umum database** pada website e-commerce fashion. Database dirancang menggunakan **basis data relasional** untuk mendukung fitur belanja, transaksi, return, pengiriman dan subscription.

---

## Tujuan Database

- Menyimpan data user dan customer
- Mengelola produk fashion beserta varian dan stok
- Mendukung proses keranjang, pesanan, pembayaran, dan pengiriman
- Mendukung fitur return, promo, wishlist, review, dan subscription

## Ringkasan Desain Database

- Database menggunakan konsep relasional
- Setiap tabel memiliki primary key
- Relasi antar tabel menggunakan foreign key
- Struktur database mendukung skalabilitas sistem

## Entitas Utama dan Fungsinya
# Desain Basis Data – Sistem E-Commerce (Zalora-like)

Dokumen ini menjelaskan beberapa tabel utama dalam perancangan basis data sistem e-commerce, beserta atribut, relasi, dan fungsinya. Setiap tabel dirancang untuk mendukung proses bisnis secara efisien dan terintegrasi.

---


# 1. Tabel Users  
*(Ditambahkan oleh Tika Isnaeni)*

### Deskripsi  
Tabel `users` merupakan hasil penggabungan antara tabel **User** dan **Customer**. Penggabungan ini dilakukan untuk meningkatkan efisiensi penyimpanan data serta menghindari redundansi. Dalam sistem e-commerce (Zalora-like), customer pada dasarnya adalah user yang telah melakukan autentikasi dan melakukan aktivitas transaksi, sehingga pemisahan tabel dianggap tidak diperlukan.

### Atribut  
Tabel `users` memiliki atribut sebagai berikut:

- `user_id` : Primary key yang mengidentifikasi setiap pengguna secara unik  
- `role` : Menentukan peran pengguna dalam sistem (customer atau admin)  
- `email` : Digunakan sebagai identitas login pengguna  
- `password` : Menyimpan kata sandi pengguna dalam bentuk terenkripsi  
- `phone` : Menyimpan nomor telepon pengguna  
- `status` : Menunjukkan status akun pengguna (aktif / nonaktif)  
- `last_login` : Mencatat waktu terakhir pengguna melakukan login  
- `full_name` : Menyimpan nama lengkap pengguna  
- `gender` : Menyimpan jenis kelamin pengguna  
- `birth_date` : Menyimpan tanggal lahir pengguna  
- `registered_at` : Mencatat waktu pendaftaran akun  

### Relasi  
Tabel `users` memiliki relasi dengan beberapa tabel lain, yaitu:

- **users – alamat_pengiriman** (1 : N)  
  Satu pengguna dapat memiliki lebih dari satu alamat pengiriman  

- **users – keranjang** (1 : 1)  
  Satu pengguna memiliki satu keranjang belanja aktif  

- **users – pesanan** (1 : N)  
  Satu pengguna dapat melakukan banyak pesanan  

- **users – wishlist** (1 : N)  
  Satu pengguna dapat memiliki banyak item wishlist  

- **users – user_subscription** (1 : N)  
  Satu pengguna dapat memiliki satu atau lebih data subscription  

- **users – return** (1 : N)  
  Satu pengguna dapat mengajukan beberapa pengajuan return  

- **users – review** (1 : N)  
  Satu pengguna dapat memberikan banyak ulasan produk  

- **users – log_aktivitas** (1 : N)  
  Satu pengguna memiliki banyak catatan log aktivitas  

- **users – riwayat_pencarian** (1 : N)  
  Satu pengguna memiliki banyak riwayat pencarian produk

- **users - klaim promo** (1 : N)
  Satu pengguna memiliki banyak promo yang dapat diklaim

### Fungsi  
Tabel `users` berfungsi sebagai pusat data pengguna dalam sistem e-commerce. Tabel ini digunakan untuk mengelola autentikasi dan otorisasi pengguna, menyimpan data profil customer, serta menjadi referensi utama bagi seluruh aktivitas pengguna seperti transaksi, subscription, pengajuan return, dan penggunaan promo. Dengan adanya tabel ini, sistem dapat mengelola data pengguna secara terintegrasi dan konsisten.

### Catatan Normalisasi  
Penggabungan tabel **User** dan **Customer** dilakukan untuk menjaga normalisasi data hingga **Third Normal Form (3NF)**, mengurangi duplikasi data, serta meningkatkan performa query dalam sistem e-commerce.

---

## Analisis Kebutuhan Sistem

Dalam sistem e-commerce, promo memiliki karakteristik:

# 2. Tabel : Alamat Pengiriman
(Ditambahkan oleh Sae Al Chaq
**Normalisasi Basis data**

## Deskripsi Awal Tabel

Tabel **Alamat Pengiriman** digunakan untuk menyimpan informasi alamat tujuan pengiriman barang pada sistem e-commerce.

### Atribut Tabel

| Atribut       | Keterangan                    |
| ------------- | ----------------------------- |
| address_id    | Primary Key alamat            |
| customer_id   | Foreign Key ke tabel Customer |
| label         | Penanda alamat (Rumah/Kantor) |
| nama_penerima | Nama penerima paket           |
| telepon       | Nomor telepon penerima        |
| alamat        | Detail alamat jalan           |
| provinsi      | Provinsi tujuan               |
| kota          | Kota tujuan                   |
| kecamatan     | Kecamatan tujuan              |
| kode_pos      | Kode pos                      |
| is_default    | Penanda alamat utama          |
| dibuat_pada   | Waktu pembuatan alamat        |

## Analisis Kebutuhan Sistem

Dalam sistem e-commerce:

* Satu customer **dapat memiliki lebih dari satu alamat pengiriman**
* Alamat **digunakan berulang** untuk banyak pesanan
* Alamat harus tetap tersimpan walaupun pesanan selesai
* Alamat berpengaruh langsung ke proses logistik dan pengiriman

Artinya, alamat **bukan data sementara**, melainkan **data master milik customer**.

## Proses Normalisasi

### First Normal Form (1NF)

* Semua atribut bersifat atomik
* Tidak ada atribut multivalue

**Memenuhi 1NF**

### Second Normal Form (2NF)

* Primary Key tunggal (`address_id`)
* Seluruh atribut bergantung penuh pada Primary Key

**Memenuhi 2NF**

### Third Normal Form (3NF)

* Tidak terdapat dependensi transitif
* Data customer dipisah ke tabel Customer

**Memenuhi 3NF**

## Keputusan Normalisasi

### Wajib Dijadikan Tabel di Database

**Tabel Alamat Pengiriman harus menjadi tabel tersendiri di database**, bukan hanya diproses di aplikasi.

### Alasan Utama

1. Alamat merupakan **entitas bisnis**
2. Digunakan oleh banyak transaksi (Order)
3. Bersifat permanen dan berulang
4. Mencegah pengulangan alamat di tabel Order
5. Mendukung histori dan audit

## Koreksi & Keterkaitan dengan 28 Tabel Lain

### Tabel yang Berkaitan Langsung

| Tabel             | Relasi         | Keterangan                        |
| ----------------- | -------------- | --------------------------------- |
| Customer          | 1 → N          | Satu customer punya banyak alamat |
| Order             | 1 → 1          | Order menggunakan satu alamat     |
| Detail Pengiriman | 1 → 1          | Menggunakan alamat tujuan         |
| Jasa Pengiriman   | Tidak langsung | Estimasi dan rute pengiriman      |

### Tabel yang **TIDAK BOLEH DIGABUNG**

| Tabel             | Alasan                            |
| ----------------- | --------------------------------- |
| Order             | Menghindari redundansi alamat     |
| Customer          | Customer bisa punya banyak alamat |
| Detail Pengiriman | Fokus ke status & tracking        |

### Apakah Ada Tabel yang Sama atau Duplikat?

**Tidak ada tabel lain yang memiliki fungsi sama** dengan Tabel Alamat Pengiriman.

Namun:

* Tabel **Lokasi Operasional** ➜ alamat internal perusahaan
* Tabel **Detail Pengiriman** ➜ status & proses pengiriman

**Ketiganya berbeda fungsi dan tidak boleh disatukan**.

## Relasi Antar Tabel (Ringkas)

```text
+-----------------------+        +-----------------------------+
|       CUSTOMER        | 1    N |     ALAMAT_PENGIRIMAN       |
+-----------------------+--------+-----------------------------+
| PK customer_id        |        | PK address_id               |
| email                 |        | FK customer_id              |
| status                |        | label                       |
+-----------------------+        | nama_penerima               |
                                 | telepon                     |
                                 | alamat                      |
                                 | provinsi                    |
                                 | kota                        |
                                 | kecamatan                   |
                                 | kode_pos                    |
                                 | is_default                  |
                                 | dibuat_pada                 |
                                 +-----------------------------+

+-----------------------------+        +----------------------+
|     ALAMAT_PENGIRIMAN       | 1    N |        ORDER         |
+-----------------------------+--------+----------------------+
| PK address_id               |        | PK order_id          |
| FK customer_id              |        | FK user_id           |
+-----------------------------+        | FK address_id        |
                                       | order_date           |
                                       | status               |
                                       | total_price          |
                                       +----------------------+

+----------------------+        +-----------------------------+
|        ORDER         | 1    1 |     DETAIL_PENGIRIMAN       |
+----------------------+--------+-----------------------------+
| PK order_id          |        | PK detail_pengiriman_id     |
| FK address_id        |        | FK order_id                 |
+----------------------+        | courier_id                  |
                                | tracking_number             |
                                | shipped_at                  |
                                | delivered_at                |
                                | pengiriman_status           |
                                +-----------------------------+

```

## Kesalahan Desain yang Harus Dihindari

Menyimpan alamat langsung di tabel Order
Mengelola alamat hanya sebagai object di aplikasi
Menyimpan alamat berulang di setiap transaksi

Dampak:

* Data ganda
* Sulit update alamat
* Tidak konsisten

## Kesimpulan

### Jawaban Final

> **Tabel Alamat Pengiriman WAJIB dijadikan tabel di database**.

### Ringkasan

* Memenuhi prinsip normalisasi hingga 3NF
* Tidak tumpang tindih dengan 28 tabel lain
* Memiliki relasi jelas dan terpisah
* Tidak boleh digantikan oleh logic aplikasi


---


# 3. Tabel Produk 
*(Ditambahkan oleh Faiq Ahmad)*

## No. 1: Analisis Atribut pada Tabel Produk

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

##  No. 2: Relasi Tabel Produk dengan Tabel Teman Lain

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


---

# 4.

---

# 5.

---

# 6. Tabel Inventory  
*(Ditambahkan oleh Daris Nabil Maftuh)*
**NORMALISASI TABEL INVENTORY / STOK**

### 1. Entitas Utama
Inventory merupakan entitas utama yang berfungsi menyimpan data stok produk berdasarkan varian dan lokasi penyimpanan. Tabel ini berperan penting dalam mengontrol ketersediaan barang pada sistem e-commerce.

### 2. Atribut
Tabel Inventory memiliki atribut sebagai berikut:
- inventory_id (PK)
- variant_id (FK)
- location_id (FK)
- stock_qty
- stock_minimum
- stock_status
- last_updated

Setiap atribut memiliki fungsi spesifik dan tidak saling bergantung secara transitif.

### 3. Relasi Antar Tabel
Relasi tabel Inventory dengan tabel lain adalah:
- Inventory berelasi dengan tabel Varian melalui atribut variant_id.
- Inventory berelasi dengan tabel Lokasi Operasional melalui atribut location_id.

Relasi ini memungkinkan pengelolaan stok berdasarkan varian produk dan lokasi penyimpanan (gudang/toko).

### 4. ERD (Entity Relationship Diagram)

```ERD
+--------------------+      1        N      +--------------------+
|       VARIAN       |-------------------->|     INVENTORY      |
+--------------------+                     +--------------------+
| variant_id (PK)    |                     | inventory_id (PK)  |
| product_id (FK)    |                     | variant_id (FK)    |
| nama_varian        |                     | location_id (FK)   |
| harga              |                     | stock_qty          |
+--------------------+                     | stock_minimum      |
                                           | stock_status       |
                                           | last_updated       |
                                           +--------------------+
                                                     |
                                                     | N
                                                     |
                                                     | 1
                                           +------------------------+
                                           |  LOKASI_OPERASIONAL   |
                                           +------------------------+
                                           | location_id (PK)       |
                                           | nama_lokasi            |
                                           | tipe_lokasi            |
                                           +------------------------+
```
### 5. Keputusan Normalisasi
Berdasarkan analisis normalisasi:
- Tabel Inventory **tidak digabungkan** dengan tabel Varian maupun Produk.
- Pemisahan tabel dilakukan untuk menghindari redundansi data dan menjaga konsistensi stok.
- Tabel Inventory berdiri sendiri sebagai tabel transaksi stok dan memenuhi prinsip **Third Normal Form (3NF)**.

Keputusan ini mendukung sistem agar lebih fleksibel jika dikembangkan menjadi multi-gudang.

### 6. Kesimpulan
Tabel Inventory dirancang sebagai entitas mandiri untuk mengelola data stok secara akurat dan efisien. Dengan penerapan normalisasi hingga 3NF, struktur tabel menjadi lebih rapi, mudah dikembangkan, serta mendukung integritas data dalam proses transaksi dan manajemen persediaan.


---

## 7.

---

## 8.

---

# 9. Tabel Subscription
*(Ditambahkan oleh Hamudi Bait Khalimi)*

### 1. Deskripsi Umum
Tabel **Subscription** merupakan tabel master yang digunakan untuk menyimpan data paket langganan yang tersedia dalam sistem.  
Tabel ini tidak menyimpan data pengguna maupun periode langganan user, melainkan hanya mendefinisikan jenis paket langganan secara umum.

### 2. Fungsi Tabel Subscription
- Menyediakan daftar paket langganan yang dapat dipilih oleh user
- Menyimpan informasi harga dan durasi paket
- Menjadi referensi utama bagi tabel `User_Subscription`
- Memisahkan data master paket dari data transaksi user (normalisasi)

### 3. Atribut Tabel Subscription

| Nama Atribut | Tipe Data | Keterangan |
|--------------|----------|------------|
| `subsc_id` | INT | Primary Key, identitas unik setiap paket langganan |
| `nama_langganan` | VARCHAR(100) | Nama paket langganan (contoh: Basic, Premium) |
| `deskripsi` | TEXT | Penjelasan singkat mengenai fitur atau benefit paket |
| `price` | DECIMAL(12,2) | Harga paket langganan |
| `duration_days` | INT | Durasi langganan dalam satuan hari |
| `status` | ENUM('ACTIVE','INACTIVE') | Status ketersediaan paket langganan |

### 4. Penjelasan Fungsi Setiap Atribut
- **subsc_id**  
  Digunakan sebagai identitas unik paket langganan dan sebagai referensi Foreign Key pada tabel lain.
- **nama_langganan**  
  Menampilkan nama paket agar mudah dikenali oleh user.
- **deskripsi**  
  Memberikan informasi tambahan mengenai benefit paket.
- **price**  
  Menentukan biaya yang harus dibayar user untuk menggunakan paket tersebut.
- **duration_days**  
  Menentukan masa berlaku paket langganan.
- **status**  
  Menentukan apakah paket masih tersedia atau tidak.

### 5. Relasi Tabel Subscription

**Relasi dengan Tabel User_Subscription**
- **Jenis Relasi:** One-to-Many (1 : N)
- **Penjelasan:**  
  Satu Subscription dapat digunakan oleh banyak User_Subscription, tetapi satu User_Subscription hanya merujuk pada satu Subscription.


**Alasan Tidak Berelasi Langsung dengan User**
- Subscription adalah data master
- Data user dan periode langganan dicatat pada tabel `User_Subscription`
- Menghindari redundansi data dan anomali

### 6. Analisis Desain Tabel
- Tabel Subscription hanya menyimpan data yang bersifat **umum dan tetap**
- Tidak menyimpan data:
  - user_id
  - start_date
  - end_date
- Desain ini memisahkan:
  - **data master** (Subscription)
  - **data transaksi/riwayat** (User_Subscription)

Keuntungan desain:
- Mudah melakukan perubahan harga atau durasi
- Tidak mempengaruhi data langganan user yang sudah ada
- Struktur database lebih fleksibel dan terstruktur

### 7. Normalisasi Tabel Subscription

**First Normal Form (1NF)**
- Semua atribut bernilai atomik
- Tidak ada atribut multivalue
✅ Terpenuhi

**Second Normal Form (2NF)**
- Primary key tunggal (`subsc_id`)
- Semua atribut bergantung penuh pada primary key
✅ Terpenuhi

**Third Normal Form (3NF)**
- Tidak ada ketergantungan transitif
- Semua atribut non-key hanya bergantung pada `subsc_id`
✅ Terpenuhi

### 8. Kesimpulan
Tabel Subscription telah dirancang sebagai tabel master yang terpisah dari data user dan transaksi.  
Desain ini memenuhi prinsip normalisasi hingga **Third Normal Form (3NF)** serta mendukung integrasi yang baik dengan tabel `User_Subscription`.

### 9. Ringkasan Singkat
- Subscription = tabel master
- Tidak menyimpan data user
- Relasi hanya ke User_Subscription
- Desain terstruktur dan ter-normalisasi


  Alasan:

1. Promo merupakan entitas bisnis, bukan sekadar atribut tambahan
2. Memiliki periode berlaku dan status yang jelas
3. Dapat digunakan pada lebih dari satu transaksi (Order)
4. Menghindari redundansi data pada tabel Order
5. Mendukung pengelolaan dan pengembangan promo di masa depan

---

# 10. Tabel User Subcription
*(Ditambahkan oleh Piejar Annisa Berlianti)*
**NORMALISASI BASIS DATA**

## Deskripsi Awal Tabel

**Detail Paket Langganan (User Subcription)** pada sistem e-commerce.

### Atribut Awal
| Nama Atribut | Tipe Data | Keterangan |
| --- | --- | --- |
| `user_subsc_id` | INT | **Primary Key**. ID unik untuk setiap catatan langganan pengguna. |
| `subs_id` | INT | **Foreign Key**. Merujuk ke tabel `subscriptions` (Paket Langganan). |
| `user_id` | INT | **Foreign Key**. Merujuk ke tabel `users` (Pengguna). |
| `start_date` | DATETIME | Tanggal dan waktu langganan mulai berlaku. |
| `end_date` | DATETIME | Tanggal dan waktu langganan berakhir/kedaluwarsa. |
| `status` | ENUM/VARCHAR(20) | Status langganan (misalnya: `ACTIVE`, `EXPIRED`, `CANCELED`, `TRIAL`). |

B. Analisis Kebutuhan Sistem
Tabel user_subscriptions adalah entitas transaksional yang sangat penting dalam sistem berbasis langganan karena:

- Histori Kepemilikan: Satu pengguna dapat memiliki banyak langganan dari waktu ke waktu (misalnya, langganan tahunan pertama berakhir, lalu membeli yang kedua). Tabel ini mencatat seluruh riwayat tersebut.

- Kontrol Akses: Digunakan sebagai sumber tunggal kebenaran (single source of truth) untuk menentukan apakah seorang pengguna berhak mengakses fitur premium pada waktu tertentu (memeriksa user_id dan status = 'ACTIVE' di antara start_date dan end_date).

- Fleksibilitas Paket: Memungkinkan paket langganan (subs_id) diperbarui atau diubah tanpa perlu memodifikasi data pengguna, cukup dengan menambahkan baris baru dengan end_date yang baru.

- Audit dan Metrik: Menyediakan data penting untuk metrik bisnis seperti tingkat retensi (retention rate) dan tingkat churn (pembatalan).

## Proses Normalisasi

###First Normal Form (1NF)
**Syarat:** Semua atribut bersifat atomik (tidak dapat dibagi lagi) dan tidak ada *multivalue* dalam satu sel.

* **Tindakan:** Atribut seperti `start_date`, `end_date`, `subs_id`, dan `user_id` sudah atomik. Tidak ada pengulangan kolom.
* **Kesimpulan:** Struktur tabel `user_subscriptions` **Memenuhi 1NF**.

###Second Normal Form (2NF)
**Syarat:** Harus memenuhi 1NF, dan semua atribut non-kunci harus bergantung penuh pada seluruh *Primary Key*. (Ini relevan jika PK adalah kunci gabungan/komposit).

* **Tindakan:** *Primary Key* kita adalah `user_subsc_id` (kunci tunggal/sederhana).
* Kolom non-kunci (`start_date`, `end_date`, `status`, `subs_id`, `user_id`) semuanya bergantung langsung dan penuh pada `user_subsc_id`.
* Jika `subs_id` (misalnya, *Nama Paket*) ada di sini, itu akan melanggar 2NF (karena *Nama Paket* bergantung pada `subs_id`, yang hanya bagian dari PK jika kita menggunakan PK gabungan). Karena `subs_id` sudah menjadi Foreign Key yang merujuk ke tabel master `subscriptions`, maka 2NF terpenuhi.


* **Kesimpulan:** Struktur tabel **Memenuhi 2NF**.

###Third Normal Form (3NF)
**Syarat:** Harus memenuhi 2NF, dan tidak boleh ada ketergantungan transitif (kolom non-kunci tidak boleh bergantung pada kolom non-kunci lainnya).

* **Contoh Pelanggaran (Jika Ada):** Jika kita memasukkan `subscription_name` (nama paket, kolom non-kunci) langsung ke tabel ini, maka `subscription_name` bergantung pada `subs_id` (kolom non-kunci). Ini akan melanggar 3NF.
* **Tindakan:** Karena `subscription_name` dan detail paket lainnya (`price`, `duration`) sudah dipisahkan ke tabel master **`subscriptions`** dan hanya direferensikan melalui `subs_id` (Foreign Key), maka tidak ada ketergantungan transitif di tabel `user_subscriptions`.
* **Kesimpulan:** Struktur tabel **Memenuhi 3NF**.


##🚀 Kesimpulan Normalisasi
Tabel `user_subscriptions` yang dirancang dengan atribut:

* `user_subsc_id` (PK)
* `subs_id` (FK)
* `user_id` (FK)
* `start_date`
* `end_date`
* `status`

telah mencapai **Third Normal Form (3NF)**, menjadikannya struktur yang efisien dan bebas dari anomali pembaruan.

Baik, langkah selanjutnya dalam dokumentasi normalisasi adalah mendefinisikan **Relasi Antar Tabel** yang melibatkan entitas `user_subscriptions`.

Tabel ini menghubungkan dua entitas master: `users` dan `subscriptions`. Kedua relasi tersebut adalah *One-to-Many* (1:N).

##🔗 Relasi Antar Tabel (User Subscription)| Relasi | Tipe Relasi | Penjelasan |
| --- | --- | --- |
| **Users \rightarrow User Subscriptions** | One-to-Many (1:N) | **Satu** Pengguna (`user_id`) dapat memiliki **Banyak** catatan langganan (`user_subsc_id`) sepanjang waktu (riwayat langganan). |
| **Subscriptions \rightarrow User Subscriptions** | One-to-Many (1:N) | **Satu** Paket Langganan (`subs_id`) dapat dimiliki oleh **Banyak** pengguna yang berbeda. |


###Relasi Antar Tabel
## ERD (ASCII Diagram)

```
+-----------+        +-------------------+        +--------------+
|   USERS   | 1    N | USER_SUBSCRIPTIONS| N    1 | SUBSCRIPTIONS|
+-----------+--------+-------------------+--------+--------------+
| user_idPK |        | user_subsc_idPK   |        | subs_idPK    |
| username  |        | user_idFK         |        | name         |
+-----------+        | subs_idFK         |        | price        |
                     | start_date        |        +--------------+
                     | end_date          |
                     | status            |
                     +-------------------+

```

---

# 11. Tabel Keranjang Sementara
*(Ditambahkan oleh Moh Ilham Dwinanto)*

### Deskripsi
Keranjang Sementara pada sistem e-commerce digunakan untuk menyimpan daftar produk yang dipilih oleh user sebelum dilakukan proses checkout dan pembuatan pesanan (Order). Keranjang bersifat sementara dan dapat berubah sewaktu-waktu selama user belum menyelesaikan transaksi.

- Promo (1) → (N) Klaim_Promo
- User (1) → (N) Klaim_Promo
- Promo (1) → (N) Order

## ERD 

```
+-------------+     1     N     +----------------+     N     1     +-------------+
|   PROMO     |--------------- |  KLAIM_PROMO   |--------------- |    USER     |
+-------------+                 +----------------+                 +-------------+
| promo_idPK  |                 | klaim_idPK     |                 | user_idPK   |
| kode_promo  |                 | promo_idFK     |                 | name        |
| jenis_diskon|                 | user_idFK      |                 | email       |
| nilai_diskon|                 | used_at        |                 |             |
| start_date  |                 | status         |                 |             |
| end_date    |                 +----------------+                 +-------------+
| status      |
+-------------+
```
### Atribut
- `keranjang_id`   : sebagai Primary Key keranjang
- `user_id`        : sebagai Foreign Key ke tabel user
- `total_qty`      : total jumlah item dalam keranjang
- `total_price`    : total harga seluruh item
- `last_update`    : waktu terakhir keranjang diperbarui

### Relasi
- user -> keranjang (1:1) : satu user hanya memiliki satu keranjang aktif
- keranjang -> item_keranjang (1:N) : satu keranjang dapat berisi banyak item

### Fungsi
Digunakan untuk menyimpan daftar produk yang dipilih oleh user sebelum dilakukan proses checkout dan pembuatan pesanan (Order).

---

# 12. Tabel Item Keranjang Sementara
*(Ditambahkan oleh Nicko Ikhwan Prayogi)*

### Deskripsi
Item Keranjang Sementara pada sistem e-commerce digunakan untuk menyimpan data produk yang dipilih oleh user didalam keranjang sebelum dilakukan proses checkout dan pembuatan pesanan (Order). Item Keranjang bersifat sementara dan dapat berubah sewaktu-waktu selama user belum menyelesaikan transaksi.

---

### Atribut
- `item_keranjang_id`   : sebagai Primary Key Item keranjang
- `keranjang_id`        : sebagai Foreign Key ke tabel Keranjang
- `variant_id`          : sebagai Foreign Key ke tabel Variant
- `quantity`            : jumlah total dari suatu produk di dalam keranjang
- `subtotall`           : total harga dari satu produk di dalam keranjang

---

### Relasi
- keranjang -> item_keranjang (1:N) : satu keranjang dapat berisi banyak item
```
           1
           |
           |
           N
     +-------------+
     |   ORDER     |
     +-------------+
     | order_idPK  |
     | user_idFK   |
     | promo_idFK  |
     | order_date  |
     | total_price |
     +-------------+

```

## Perbandingan dengan Tabel Mahasiswa Lain

|  Mahasiswa   |  Tabel       |                          Konsistensi                                           |     |
| ----------   | -----------  | ------------------------------------------------------------------------------ | --- |
| User         | Customer     | Promo dapat dibatasi per pengguna atau segmen tertentu (melalui klaim promo).  | ✔️  |
| Produk       | Product      | Promo dapat berlaku untuk produk, kategori, atau brand tertentu.               | ✔️  |
| Order        | Pesanan      | Promo diterapkan pada saat checkout dan tercatat pada data pesanan.            | ✔️  |
| Klaim Promo  | Ambil Promo  | Menyimpan riwayat penggunaan promo oleh pengguna serta kontrol kuota.          | ✔️  |
| Subscription | Berlangganan | Promo diterapkan pada saat checkout dan tercatat pada data pesanan.            | ✔️  |
| **Virgi**    | Promo        | Menyimpan aturan diskon secara terpisah dari transaksi.                        | ✔️  |

Struktur Promo **selaras dan konsisten** dengan tabel mahasiswa lain.

## Kesimpulan
### Fungsi
Digunakan untuk menyimpan data produk yang dipilih oleh user yang kemudian disimpan di dalam tabel Keranjang.

---

# 13. Tabel Pesanan
*(Ditambahkan oleh Syah Irkham Ramadhan)*

### Deskripsi
Tabel `Pesanan` adalah tabel transaksional utama yang mencatat setiap pembelian yang berhasil dibuat oleh pengguna. Tabel ini mengintegrasikan data dari User, Alamat Pengiriman, dan Metode Pembayaran serta menjadi induk bagi Item Pesanan.

### Atribut  
Tabel `Pesanan` memiliki atribut sebagai berikut:
Nama Atribut,Keterangan,Kunci

- `order_id` : Primary Key (PK). Identitas unik untuk setiap transaksi pesanan.
- `user_id` : Foreign Key (FK) ke Tabel Users (No. 1). Pelanggan yang membuat pesanan.
- `address_id` : Foreign Key (FK) ke Tabel Alamat Pengiriman (No. 2). Alamat tujuan pesanan.
- `payment_method_id` : Foreign Key (FK) ke Tabel Metode Pembayaran (No. 16). Metode bayar yang dipilih.
- `order_date` : Tanggal dan waktu pesanan dibuat.
- `status` : Status terkini pesanan (misalnya: Paid, Shipped, Delivered).
- `total_price`,Total harga pesanan yang harus dibayar.
- `biaya_pengiriman`,Biaya pengiriman yang dikenakan.
- `tracking_number`,Nomor resi pelacakan dari jasa pengiriman.
- `created_at`,Waktu pencatatan pesanan dalam sistem.

### Relasi  
Tabel `Pesanan` memiliki relasi dengan beberapa tabel lain, yaitu:

- **users – pesanan** (1 : N)
  Satu pengguna dapat membuat banyak pesanan. (user_id di Pesanan).
  
- **alamat_pengiriman – pesanan** (1 : N)
  Satu alamat dapat digunakan untuk banyak pesanan. (address_id di Pesanan).

- **metode_pembayaran – pesanan** (1 : N)
  Satu metode pembayaran dapat digunakan untuk banyak pesanan. (payment_method_id di Pesanan).

- **pesanan – item_pesanan** (1 : N)
  Satu pesanan terdiri dari banyak item produk yang dibeli. (order_id di Item Pesanan).

- **pesanan – detail_pengiriman** (1 : 1)
  Satu pesanan memiliki satu catatan detail pengiriman. (order_id di Detail Pengiriman).

- **pesanan – detail_pembayaran** (1 : 1)
  Satu pesanan memiliki satu catatan detail pembayaran. (order_id di Detail Pembayaran).

- **pesanan – klaim_promo** (1 : 0..1 atau 1 : N)
  Satu pesanan dapat menggunakan satu atau lebih promo yang telah diklaim. (order_id di Klaim Promo).

- **pesanan – return** (1 : N)
  Satu pesanan dapat memiliki banyak pengajuan return (melalui Item Pesanan).

### Fungsi  
Tabel `Pesanan` berfungsi sebagai: 
1. Perekam Transaksi Utama: Mencatat detail dan riwayat setiap transaksi pembelian.
2. Manajemen Status: Mengelola dan memperbarui Status pesanan dari awal hingga selesai.
3. Integrator Data: Menghubungkan semua data master (User, Alamat, Pembayaran) dengan data item produk yang dibeli.

### Catatan Normalisasi  
Tabel ini dirancang untuk memenuhi Third Normal Form (3NF), di mana semua atribut non-key secara langsung bergantung pada Kunci Utama `order_id`, tanpa adanya ketergantungan transitif.

---

## 14.

---


# 15. Tabel Wishlist/Favorite
*(Ditambahkan oleh Elitsa Effie)*

### Deskripsi
**Tabel wishlist** digunakan untuk menyimpan data produk yang ditandai sebagai favorit oleh pengguna dalam sistem e-commerce. Tabel ini berperan sebagai penghubung antara tabel users dan product, serta dipisahkan dari tabel keranjang karena memiliki fungsi penyimpanan minat pengguna, bukan persiapan transaksi pembelian.
Tabel "wishlist' digunakan untuk menyimpan data produk yang ditandai sebagai favorit oleh pengguna dalam sistem e-commerce. Tabel ini berperan sebagai penghubung antara tabel users dan product, serta dipisahkan dari tabel keranjang karena memiliki fungsi penyimpanan minat pengguna, bukan persiapan transaksi pembelian.

### Atribut
Tabel wishlist memiliki atribut sebagai berikut:
- `wishlist_id` : Primary key yang mengidentifikasi setiap data wishlist secara unik
-	`user_id` : Foreign key yang mereferensikan pengguna yang menambahkan produk ke dalam wishlist
-	`product_id` : Foreign key yang mereferensikan produk yang ditandai sebagai favorit
-	`status` : Menunjukkan status wishlist (aktif atau dihapus) untuk mendukung soft delete
-	`created_at` : Mencatat waktu saat produk ditambahkan ke dalam wishlist
-	`updated_at` : Mencatat waktu terakhir data wishlist diperbarui

### Relasi
Tabel wishlist memiliki relasi dengan beberapa tabel lain, yaitu:
-	**Wishlist – Users** (N : 1)
Banyak item wishlist dimiliki oleh satu pengguna
-	**Wishlist – Product** (N : 1)
Banyak item wishlist mengacu pada satu produk
-	**Wishlist – Review** (tidak langsung)
Produk dalam wishlist dapat menjadi referensi sebelum pengguna memberikan ulasan
-	**Wishlist – Log Aktivitas** (1 : N)
Aktivitas penambahan atau penghapusan wishlist dapat dicatat sebagai log aktivitas pengguna

### Fungsi
**Tabel wishlist** berfungsi untuk menyimpan data produk yang diminati oleh pengguna serta memudahkan pengelolaan daftar produk favorit. Keberadaan tabel ini mendukung fitur lanjutan seperti rekomendasi produk dan notifikasi promo, serta membantu meningkatkan interaksi pengguna dan potensi transaksi pembelian di masa mendatang.

### Catatan Normalisasi
'Tabel wishlist' menggunakan primary key tunggal dan foreign key ke tabel 'users' dan 'product' sehingga telah memenuhi normalisasi hingga Third Normal Form (3NF). Seluruh atribut bergantung langsung pada primary key tanpa redundansi data, serta menjaga integritas data dan mendukung pengembangan fitur lanjutan.
**Tabel wishlist** menggunakan primary key tunggal dan foreign key ke tabel `users` dan `product` sehingga telah memenuhi normalisasi hingga **Third Normal Form (3NF)**. Seluruh atribut bergantung langsung pada primary key tanpa redundansi data, serta menjaga integritas data dan mendukung pengembangan fitur lanjutan.


---


# 16. Tabel Metode Pembayaran  
*(Ditambahkan oleh Panji Pramudia)*

### Deskripsi  
Tabel `payment_methods` merupakan hasil normalisasi untuk memisahkan konfigurasi teknis pembayaran dari data penyedia layanan (Partners). Dalam sistem e-commerce, satu penyedia layanan (seperti Bank) dapat memiliki berbagai jenis produk pembayaran (Virtual Account, Kartu Kredit), sehingga pemisahan tabel ini dilakukan untuk menghindari redundansi data penyedia serta memudahkan pengaturan biaya layanan yang berbeda-beda.

### Atribut  
Tabel `payment_methods` memiliki atribut sebagai berikut:
- `method_id` : Primary key yang mengidentifikasi setiap metode pembayaran secara unik  
- `partner_id` : Foreign key yang menghubungkan metode ini dengan data penyedia layanan (partners)  
- `category_id` : Foreign key yang mengelompokkan metode ke dalam jenis tertentu (seperti E-Wallet atau Transfer Bank)  
- `method_name` : Menyimpan nama tampilan metode pembayaran di aplikasi  
- `method_code` : Kode unik (slug) yang digunakan untuk integrasi API dengan payment gateway  
- `admin_fee_flat` : Menyimpan nominal biaya admin dalam bentuk rupiah tetap  
- `admin_fee_percent` : Menyimpan biaya admin dalam bentuk persentase  
- `min_amount` : Membatasi jumlah minimal transaksi yang diperbolehkan  
- `is_active` : Menunjukkan status ketersediaan metode pembayaran (aktif / nonaktif)  

### Relasi  
Tabel `payment_methods` memiliki relasi dengan beberapa tabel lain, yaitu:

- **partners – payment_methods** (1 : N)  
  Satu partner (penyedia) dapat menyediakan lebih dari satu metode pembayaran  

- **payment_categories – payment_methods** (1 : N)  
  Satu kategori pembayaran dapat membawahi banyak metode pembayaran  

- **payment_methods – payments** (1 : N)  
  Satu metode pembayaran dapat digunakan dalam banyak riwayat transaksi yang dilakukan user  

### Fungsi  
Tabel `payment_methods` berfungsi sebagai pusat konfigurasi opsi pembayaran dalam sistem e-commerce. Tabel ini digunakan untuk menampilkan pilihan bayar yang tersedia di halaman *checkout*, menjadi acuan perhitungan total biaya admin secara otomatis, serta menjadi referensi validasi bagi tabel transaksi (payments). Dengan adanya tabel ini, sistem dapat mengelola penambahan atau penonaktifan metode bayar secara dinamis tanpa mengganggu integritas data.

### Catatan Normalisasi  
Pemisahan tabel **Partners** dan **Payment Methods** dilakukan untuk menjaga normalisasi data hingga **Third Normal Form (3NF)**, mencegah duplikasi data penyedia layanan, serta mendukung skalabilitas jika terjadi penambahan produk pembayaran baru di masa depan.


---


# 17. Tabel Jasa Pengiriman 
*(ditambah oleh Rafik Hidayat)*

## Deskripsi 
Tabel Jasa_Pengiriman digunakan untuk menyimpan data perusahaan atau pihak ekspedisi yang melayani pengiriman barang kepada pelanggan. Tabel ini mencatat informasi dasar jasa pengiriman seperti nama ekspedisi, logo, dan status keaktifan. Data pada tabel ini menjadi referensi utama dalam proses pengiriman pesanan sehingga tidak terjadi pengulangan data jasa pengiriman pada setiap transaksi.

## Atribut 
Tabel jasa pengiriman memiliki Atribut:

Id_Pengiriman (PK) : Primary Key, identitas unik jasa pengiriman
Nama_Pengiriman : Nama ekspedisi (JNE, J&T, dll)
Service_Type : Jenis layanan (REG, YES, ECO, dll)
Estimasi_Delivery_Days : Estimasi waktu pengiriman
Logo : Logo jasa pengiriman
Status : Aktif / Nonaktif

## Relasi
Relasi 1: Jasa_Pengiriman → Detail_Pengiriman
One to Many (1 : N)
Satu jasa pengiriman bisa digunakan oleh banyak pengiriman
Relasi:
Jasa_Pengiriman.Courier_Id (PK)
Detail_Pengiriman.Courier_Id (FK)

Relasi 2: Pesanan → Detail_Pengiriman
One to One / One to Many
Setiap pesanan memiliki detail pengiriman
Relasi:
Pesanan.Order_Id (PK)
Detail_Pengiriman.Order_Id (FK)
- `Id_Pengiriman` (PK) : Primary Key, identitas unik jasa pengiriman  
- `Nama_Pengiriman` : Nama ekspedisi (JNE, J&T, dll)  
- `Service_Type` : Jenis layanan (REG, YES, ECO, dll)  
- `Estimasi_Delivery_Days` : Estimasi waktu pengiriman  
- `Logo` : Logo jasa pengiriman  
- `Status` : Aktif / Nonaktif  

## Relasi

### Relasi 1: Jasa_Pengiriman → Detail_Pengiriman
One to Many (1 : N)  
Satu jasa pengiriman bisa digunakan oleh banyak pengiriman  

Relasi:
- Jasa_Pengiriman.Courier_Id (PK)  
- Detail_Pengiriman.Courier_Id (FK)  

### Relasi 2: Pesanan → Detail_Pengiriman
One to One / One to Many  
Setiap pesanan memiliki detail pengiriman  

Relasi:
- Pesanan.Order_Id (PK)  
- Detail_Pengiriman.Order_Id (FK)  

## Fungsi 
Tabel Jasa_Pengiriman berfungsi untuk menyimpan dan mengelola data master perusahaan ekspedisi yang digunakan dalam proses pengiriman pesanan. Tabel ini menjadi referensi utama dalam menentukan jasa pengiriman pada setiap transaksi, sehingga sistem dapat mencatat informasi pengiriman secara konsisten dan terstruktur. Selain itu, tabel ini membantu menghindari duplikasi data jasa pengiriman, memudahkan pengelolaan layanan pengiriman, serta mendukung integritas data dalam sistem informasi penjualan atau e-commerce.


---

# 18. Tabel Detail Pengiriman
*(Ditambahkan oleh Fajar Niko Pratama)*

# Analisis & Perancangan Tabel Detail Pengiriman

Dokumen ini menjelaskan perancangan tabel *Detail Pengiriman* yang berfungsi menyimpan informasi spesifik mengenai proses logistik dan status pengiriman untuk setiap pesanan yang telah dibuat pada sistem e-commerce.

## 1. Latar Belakang Perancangan Tabel

Tabel *Detail Pengiriman* (Tabel 18) dirancang untuk memisahkan data spesifik logistik dari tabel utama *Pesanan* (Tabel 13). Pemisahan ini penting untuk menjaga 3NF dan memfokuskan tabel pesanan pada data transaksional, sementara tabel ini fokus pada data operasional pengiriman.

Perancangan tabel ini bertujuan untuk:

* Mencatat nomor resi (Tracking_Number) untuk pelacakan.
* Mencatat timeline pengiriman yang akurat (kapan dikirim dan kapan diterima).
* Menyediakan status pengiriman yang real-time kepada customer.

## 2. Struktur Tabel Detail Pengiriman

### Nama Tabel

Detail Pengiriman

### Atribut Tabel

| Nama Atribut | Keterangan |
| :--- | :--- |
| Detail_Pengiriman_Id | Primary Key sebagai identitas unik data detail pengiriman. |
| Order_Id | Foreign Key (FK) merujuk ke tabel Pesanan (Tabel 13). Mengidentifikasi pesanan mana yang terkait dengan detail ini. |
| Courier_Id | Foreign Key (FK) merujuk ke tabel Jasa Pengiriman (Tabel 17). Mengidentifikasi layanan pengiriman yang digunakan. |
| Tracking_Number | Nomor resi resmi dari jasa pengiriman. |
| Shipped_At | Tanggal dan waktu paket diserahkan ke kurir atau mulai dikirim. |
| Delivered_At | Tanggal dan waktu paket berhasil diterima oleh customer. |
| Pengiriman_Status | Status terbaru paket (misalnya: Diambil Kurir, Dalam Perjalanan, Tiba di Hub, Diterima). |

## 3. Relasi Tabel Detail Pengiriman

Tabel Detail Pengiriman adalah tabel yang sangat terikat dengan alur transaksi:

| Tabel Terkait | Jenis Relasi | Keterangan |
| :--- | :--- | :--- |
| *Pesanan* (Tabel 13) | 1 : 1 | Satu Pesanan memiliki Satu Detail Pengiriman (Order_Id FK). |
| *Jasa Pengiriman* (Tabel 17) | N : 1 | Banyak Detail Pengiriman menggunakan Satu Jenis Layanan Pengiriman (Courier_Id FK). |
| *Patner Company* (Tabel 28) | N : 1 | Secara tidak langsung, Jasa Pengiriman terkait dengan Partner Company (Logistik). |

## 4. Fungsi Tabel Detail Pengiriman

Tabel Detail Pengiriman berfungsi sebagai:

* *Pencatat Logistik:* Menyimpan data logistik yang spesifik untuk setiap transaksi.
* *Integrasi Kurir:* Menghubungkan sistem e-commerce dengan sistem pelacakan kurir melalui Tracking_Number dan Courier_Id.
* *Pembaruan Status:* Menjadi sumber utama informasi untuk memperbarui Pengiriman_Status yang dilihat oleh customer.

## 5. Analisis Normalisasi

### First Normal Form (1NF)

* Semua atribut bernilai atomik.
* Tidak terdapat atribut multivalue.
* Setiap record memiliki primary key (Detail_Pengiriman_Id).

*Status: Memenuhi 1NF*

### Second Normal Form (2NF)

* Primary key terdiri dari satu atribut yaitu Detail_Pengiriman_Id.
* Semua atribut non-key bergantung sepenuhnya pada primary key.

*Status: Memenuhi 2NF*

### Third Normal Form (3NF)

* Tidak terdapat ketergantungan transitif.
* Data Jasa Pengiriman dipisahkan ke tabel master (Jasa Pengiriman / Tabel 17).

*Status: Memenuhi 3NF*

---

# 19.

---

# 20. Tabel Return  
*(ditambahkan oleh Fifi Nurfadilah)*

## Atribut Awal

| Atribut        | Keterangan                                  |
|---------------|----------------------------------------------|
| return_id     | Primary Key tabel return                     |
| order_item_id | Foreign Key ke tabel item pesanan            |
| reason        | Alasan pengembalian barang                   |
| status        | Status retur (pending, approved, rejected)  |
| request_date  | Tanggal pengajuan retur                      |
| resolved_date | Tanggal penyelesaian retur                   |

## Proses Normalisasi

### First Normal Form (1NF)

Syarat 1NF:
- Tidak ada atribut bernilai ganda (multivalue)
- Setiap field bersifat atomik

**Analisis:**
- Semua atribut berisi satu nilai
- Tidak ada pengulangan kolom

✅ **LULUS 1NF**

### Second Normal Form (2NF)

Syarat 2NF:
- Sudah memenuhi 1NF
- Semua atribut non-key bergantung penuh pada Primary Key

**Analisis:**
- Primary Key: `return_id`
- Semua atribut lain (reason, status, request_date, resolved_date) bergantung langsung pada `return_id`

✅ **LULUS 2NF**

### Third Normal Form (3NF)

Syarat 3NF:
- Sudah memenuhi 2NF
- Tidak ada ketergantungan transitif antar atribut non-key

**Analisis:**
- Tidak ada atribut non-key yang bergantung pada atribut non-key lain
- `status` tidak menentukan tanggal, dan sebaliknya

✅ **LULUS 3NF**

# Keputusan Desain Database

**Alasan:**

1. **Data Return bersifat permanen**
   - Retur merupakan bagian dari riwayat transaksi
   - Dibutuhkan untuk audit, laporan, dan bukti transaksi

2. **Memiliki relasi langsung dengan tabel lain**
   - Relasi ke `Order_Item`
   - Digunakan oleh admin, customer service, dan sistem logistik

3. **Mencegah kehilangan data**
   - Jika hanya diproses di aplikasi, data akan hilang saat aplikasi ditutup atau error

4. **Mendukung tracking & histori**
   - Status retur dapat berubah (pending → approved → resolved)
   - Perubahan status harus tersimpan

5. **Sesuai prinsip normalisasi**
   - Menghindari redundansi
   - Data terstruktur dan konsisten

## Relasi Antar Tabel

- **Order (1) → (N) Order_Item**
- **Order_Item (1) → (0..1) Return**

## ERD (Sederhana)
+------------------+ +-------------------+
| Order_Item | 1 0 | Return |
+------------------+--------+-------------------+
| order_item_id(PK)| | return_id (PK) |
| order_id (FK) | | order_item_id(FK) |
| variant_id (FK) | | reason |
| quantity | | status |
| price | | request_date |
+------------------+ | resolved_date |
+-------------------+

## Kesimpulan

Tabel **Return**:

- ✅ Memenuhi normalisasi hingga **3NF**
- ✅ **WAJIB dijadikan tabel database**
- ❌ Tidak cukup jika hanya diproses di aplikasi
- 📌 Digunakan untuk histori, audit, dan validasi transaksi

Dengan demikian, **tabel Return harus disimpan di database**, bukan hanya sebagai proses sementara di aplikasi.

---

# 21. Tabel Promo
*(Ditambahkan oleh Virgiawan Ananda Purwoko)*
**Normalisasi Basis Data**

### Deskripsi Awal Tabel

**Detail Promosi** pada sistem e-commerce.

### Atribut Awal

| Atribut             | Keterangan                           |
| ------------------- | ------------------------------------          |
| `promo_id`          | ID unik promo (primary key)                   |
| `kode_promo`        | Kode promo yang digunakan pengguna            |
| `nama_promo`        | Nama atau judul promo                         |
| `jenis_diskon`      | Jenis diskon (persentase / nominal)           |
| `nilai_diskon`      | Besar diskon yang diberikan                   |
| `tanggal_mulai`     | Tanggal mulai promo berlaku                   |
| `tanggal_akhir`     | Tanggal promo berakhir                        |
| `minimal_transaksi` | Minimum nilai transaksi agar promo aktif      |
| `maksimal_diskon`   | Batas maksimum potongan (jika persen)         |
| `kuota`             | Jumlah maksimal penggunaan promo              |
| `status`            | Status promo (aktif / nonaktif / kadaluarsa)  |
| `keterangan`        | Penjelasan atau syarat tambahan promo         |

### Analisis Kebutuhan Sistem

Dalam sistem e-commerce, promo memiliki karakteristik:

- Tidak selalu berlaku untuk semua transaksi
- Memiliki periode waktu tertentu (mulai dan berakhir)
- Dapat memiliki berbagai jenis dan aturan (persentase, nominal, syarat minimal)
- Memerlukan pengelolaan status (aktif, nonaktif, kadaluarsa)
- Dapat digunakan pada lebih dari satu pesanan (Order)

Karena itu, data promo tidak dapat digabung langsung dengan tabel Order dan perlu dikelola dalam tabel tersendiri.

### Proses Normalisasi

First Normal Form (1NF)

- Semua atribut bersifat atomik
- Tidak ada data multivalue (satu kolom satu nilai)

**Memenuhi 1NF**

Second Normal Form (2NF)

- Primary Key hanya satu (promo_id)
- Seluruh atribut bergantung penuh pada Primary Key

**Memenuhi 2NF**

Third Normal Form (3NF)

- Tidak terdapat ketergantungan transitif
- Setiap atribut non-primary tidak bergantung pada atribut non-primary lainnya

**Memenuhi 3NF**

### Keputusan Normalisasi

**Dijadikan Tabel Tersendiri**

  Alasan:

1. Promo merupakan entitas bisnis, bukan sekadar atribut tambahan
2. Memiliki periode berlaku dan status yang jelas
3. Dapat digunakan pada lebih dari satu transaksi (Order)
4. Menghindari redundansi data pada tabel Order
5. Mendukung pengelolaan dan pengembangan promo di masa depan

**Relasi Antar Tabel**

- Promo (1) → (N) Klaim_Promo
- User (1) → (N) Klaim_Promo
- Promo (1) → (N) Order

### ERD 

```
+-------------+     1     N     +----------------+     N     1     +-------------+
|   PROMO     |--------------- |  KLAIM_PROMO   |--------------- |    USER     |
+-------------+                 +----------------+                 +-------------+
| promo_idPK  |                 | klaim_idPK     |                 | user_idPK   |
| kode_promo  |                 | promo_idFK     |                 | name        |
| jenis_diskon|                 | user_idFK      |                 | email       |
| nilai_diskon|                 | used_at        |                 |             |
| start_date  |                 | status         |                 |             |
| end_date    |                 +----------------+                 +-------------+
| status      |
+-------------+

           1
           |
           |
           N
     +-------------+
     |   ORDER     |
     +-------------+
     | order_idPK  |
     | user_idFK   |
     | promo_idFK  |
     | order_date  |
     | total_price |
     +-------------+

```

### Perbandingan dengan Tabel Mahasiswa Lain

|  Mahasiswa   |  Tabel       |                          Konsistensi                                           |     |
| ----------   | -----------  | ------------------------------------------------------------------------------ | --- |
| User         | Customer     | Promo dapat dibatasi per pengguna atau segmen tertentu (melalui klaim promo).  | ✔️  |
| Produk       | Product      | Promo dapat berlaku untuk produk, kategori, atau brand tertentu.               | ✔️  |
| Order        | Pesanan      | Promo diterapkan pada saat checkout dan tercatat pada data pesanan.            | ✔️  |
| Klaim Promo  | Ambil Promo  | Menyimpan riwayat penggunaan promo oleh pengguna serta kontrol kuota.          | ✔️  |
| Subscription | Berlangganan | Promo diterapkan pada saat checkout dan tercatat pada data pesanan.            | ✔️  |
| **Virgi**    | Promo        | Menyimpan aturan diskon secara terpisah dari transaksi.                        | ✔️  |

Struktur Promo **selaras dan konsisten** dengan tabel mahasiswa lain.

### Kesimpulan

- Memenuhi prinsip normalisasi hingga 3NF
- Mewakili entitas bisnis promo secara mandiri
- Mendukung pengelolaan aturan diskon, periode berlaku, dan status promo
- Menghindari redundansi data pada tabel pesanan
- Mendukung pengembangan dan skalabilitas sistem promo di masa depan


---


# 22. Tabel Klaim Promo  
*(Ditambahkan oleh Dimas Faril Ardiansyah)*

### Entitas Utama  
**Klaim Promo**

### Atribut  
- `klaim_id` : Primary key, identitas unik klaim promo  
- `user_id` : Foreign key yang menunjukkan user yang mengklaim promo  
- `promo_id` : Foreign key yang menunjukkan promo yang diklaim  
- `order_id` : Foreign key yang menunjukkan pesanan tempat promo digunakan  
- `klaim_date` : Waktu promo diklaim  
- `klaim_status` : Status klaim promo (berhasil / dibatalkan)  

### Relasi  
- **Klaim Promo – Users** (1 : N)  
  Satu user dapat mengklaim banyak promo  

- **Klaim Promo – Promo** (1 : N)  
  Satu promo dapat digunakan oleh banyak user  

- **Klaim Promo – Pesanan** (1 : 0..1)  
  Satu pesanan boleh tidak menggunakan promo, dan jika menggunakan hanya satu promo  


---


## 23.


---


# 24. Apriyoda Pratama

# NORMALISASI BASIS DATA – Apriyoda Pratama

**Proyek** : Aplikasi E-Commerce  
**Mata Kuliah** : Basis Data  
**Tahap** : Analisis & Normalisasi

## Deskripsi Awal Tabel

**Log Aktivitas (Activity Log)** digunakan untuk mencatat seluruh aktivitas pengguna
pada sistem e-commerce. Data ini diperlukan untuk keperluan audit,
keamanan sistem, pemantauan aktivitas pengguna, serta pelacakan kejadian
yang terjadi di dalam sistem.

## Atribut Tabel

| Atribut        | Keterangan                     |
| -------------- | ------------------------------ |
| `log_id`       | Primary Key log aktivitas      |
| `user_id`      | Foreign Key ke tabel User      |
| `action`       | Jenis aktivitas yang dilakukan |
| `detail`       | Detail aktivitas pengguna      |
| `tanggal_buat` | Waktu aktivitas dicatat        |

## Analisis Kebutuhan Sistem

Dalam sistem e-commerce:

* Satu pengguna dapat melakukan banyak aktivitas
* Aktivitas perlu dicatat untuk audit dan keamanan
* Data log bersifat historis dan tidak memengaruhi data utama

Oleh karena itu, tabel **Log Aktivitas** harus berdiri sendiri dan tidak
digabungkan dengan tabel **User** maupun tabel transaksi lainnya.

## Proses Normalisasi

### First Normal Form (1NF)

* Seluruh atribut bersifat atomik
* Tidak terdapat atribut bernilai ganda (multivalue)

**Kesimpulan:** Memenuhi 1NF

### Second Normal Form (2NF)

* Primary Key hanya terdiri dari satu atribut (`log_id`)
* Seluruh atribut non-key bergantung sepenuhnya pada primary key

**Kesimpulan:** Memenuhi 2NF

### Third Normal Form (3NF)

* Tidak terdapat dependensi transitif
* Informasi pengguna dipisahkan ke tabel **User**

**Kesimpulan:** Memenuhi 3NF

## Keputusan Normalisasi

Tabel **Log Aktivitas** dijadikan tabel terpisah karena:

1. Merupakan entitas pendukung sistem
2. Digunakan untuk audit dan keamanan
3. Menyimpan data historis
4. Menghindari redundansi data
5. Memudahkan pengelolaan dan analisis aktivitas pengguna

## Relasi Antar Tabel

* **User (1) → (N) Log_Aktivitas**

Satu user dapat memiliki banyak catatan log aktivitas.

## ERD (ASCII Diagram)

```text
+------------------+        1 ──── N        +----------------------+
|       USER       |-----------------------|    LOG_AKTIVITAS     |
+------------------+                       +----------------------+
| user_id (PK)     |                       | log_id (PK)          |
| email            |                       | user_id (FK)         |
+------------------+                       | action               |
                                           | detail               |
                                           | tanggal_buat         |
                                           +----------------------+
```

## Kesimpulan

Tabel **Log Aktivitas** dibuat sebagai tabel terpisah karena:

* Telah memenuhi normalisasi hingga **Third Normal Form (3NF)**
* Mendukung kebutuhan audit dan keamanan sistem
* Tidak menimbulkan redundansi data
* Mendukung pengembangan sistem e-commerce di masa depan


---

# 25.Tabel Riwayat_Pencarian
*(Ditambahkan oleh Eka Nurbela)*

### Deskripsi
Tabel riwayat_pencarian digunakan untuk menyimpan seluruh aktivitas pencarian produk yang dilakukan oleh pengguna dalam sistem e-commerce (Zalora-like). Tabel ini mencatat kata kunci pencarian, waktu pencarian, serta keterkaitannya dengan pengguna dan produk. Data pada tabel ini sangat penting untuk keperluan analisis perilaku pengguna, personalisasi rekomendasi produk, serta evaluasi tren pencarian dalam sistem.

### Atribut 
Tabel riwayat_pencarian memiliki atribut sebagai berikut:
search_id : Primary key yang mengidentifikasi setiap aktivitas pencarian secara unik
user_id : Foreign key yang mereferensikan pengguna yang melakukan pencarian
product_id : Foreign key yang mereferensikan produk yang berkaitan dengan pencarian (opsional)
keyword : Menyimpan kata kunci pencarian yang dimasukkan oleh pengguna
search_time : Mencatat waktu terjadinya aktivitas pencarian

### Relasi  
Tabel riwayat_pencarian memiliki relasi dengan tabel lain sebagai berikut:
users – riwayat_pencarian (1 : N)
Satu pengguna dapat melakukan banyak aktivitas pencarian produk
produk – riwayat_pencarian (1 : N)
Satu produk dapat muncul dalam banyak riwayat pencarian pengguna
- `search_id` : Primary key yang mengidentifikasi setiap aktivitas pencarian secara unik
- `user_id` : Foreign key yang mereferensikan pengguna yang melakukan pencarian
- `product_id` : Foreign key yang mereferensikan produk yang berkaitan dengan pencarian (opsional)
- `keyword` : Menyimpan kata kunci pencarian yang dimasukkan oleh pengguna
- `search_time` : Mencatat waktu terjadinya aktivitas pencarian

### Relasi  
Tabel riwayat_pencarian memiliki relasi dengan tabel lain sebagai berikut:
- users – riwayat_pencarian (1 : N)  
  Satu pengguna dapat melakukan banyak aktivitas pencarian produk
- produk – riwayat_pencarian (1 : N)  
  Satu produk dapat muncul dalam banyak riwayat pencarian pengguna

### Fungsi  
Tabel riwayat_pencarian berfungsi untuk mencatat dan menyimpan jejak pencarian pengguna dalam sistem e-commerce. Data dari tabel ini dapat dimanfaatkan untuk menganalisis minat dan preferensi pengguna, meningkatkan fitur rekomendasi produk, mengoptimalkan hasil pencarian, serta mendukung kebutuhan business intelligence seperti analisis tren produk yang paling sering dicari.

## Catatan
Tabel riwayat_pencarian telah dinormalisasi hingga Third Normal Form (3NF). Seluruh atribut non-kunci bergantung secara langsung pada primary key (search_id) dan tidak memiliki ketergantungan transitif. Data pengguna dan produk tidak disimpan secara redundan, melainkan direferensikan melalui foreign key (user_id dan product_id), sehingga menjaga konsistensi data dan efisiensi penyimpanan dalam sistem e-commerce.


---


# 26. Tabel Lokasi Operasional  
*(Ditambahkan oleh Najwa Alief Nursfhifa)*

### Entitas Utama  
**Lokasi Operasional**

### Atribut Utama  
- `location_id` (PK)  
- `location_name`  

### Relasi  
- **Lokasi Operasional – Inventory** (1 : N)  
  Satu lokasi operasional dapat menyimpan banyak data stok produk  

- **Lokasi Operasional – Unit Operasional** (1 : N)  
  Satu lokasi operasional dapat digunakan oleh banyak unit atau aktivitas kerja  

### Fungsi  
Tabel `lokasi_operasional` berfungsi untuk menyimpan dan mengelola data lokasi operasional sebagai referensi utama dalam sistem, memastikan konsistensi penggunaan lokasi pada berbagai modul, serta mendukung pengelolaan aktivitas operasional dan penyimpanan barang.

## Catatan

- Detail SQL dan implementasi teknis disesuaikan oleh Database Engineer (Satu Kelas)
- Dokumen ini digunakan sebagai acuan konseptual dan akademik


---

# 27.

---

# 28. Tabel Patner Company
*(Ditambahkan Oleh Mohammad Naufal Hakim Widhiananda)*
### Entitas Utama
**Patner Company (Perusahaan Mitra)**

### Atribut Utama
- `Partner_Id` (PK)
- `Name`
- `Logo_Url`
- `Type` (Logistics, Payment, Brand, Marketing)

### Relasi
- **Patner Company - Produk (1 : N)**
  Satu Partner (sebagai Brand) dapat menyediakan banyak Produk
- **Patner Company - Metode Pembayaran (1 : N)**
  Satu Partner (sebagai Payment Provider) dapat menyediakan satu atau lebih Metode Pembayaran
- **Patner Company - Jasa Pengiriman (1 : N)**
  Satu Partner (sebagai Perusahaan Logistik) dapat menyediakan berbagai Service Jasa Pengiriman
- **Patner Company - Promo (N : N)**
  Promo dapat bersifat eksklusif untuk Partner tertentu (misalnya, promo Bank X)

### Fungsi
- Berfungsi sebagai tabel master untuk menyimpan dan mengelola data perusahaan eksternal yang bekerja sama dengan e-commerce, termasuk Brand yang dijual (misalnya Nike, H&M), Penyedia Pembayaran (Bank, E-Wallet), dan Perusahaan Logistik (Jasa Pengiriman).
- Memastikan data mitra terpusat dan konsisten di seluruh modul, seperti menampilkan logo brand di halaman produk atau logo bank di halaman checkout.

---
- Memenuhi prinsip normalisasi hingga 3NF
- Mewakili entitas bisnis promo secara mandiri
- Mendukung pengelolaan aturan diskon, periode berlaku, dan status promo
- Menghindari redundansi data pada tabel pesanan
- Mendukung pengembangan dan skalabilitas sistem promo di masa depan

---
















