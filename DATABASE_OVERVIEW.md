# DATABASE OVERVIEW – E-COMMERCE

**Gambaran umum database** pada website e-commerce fashion. Database dirancang menggunakan **basis data relasional** untuk mendukung fitur belanja, transaksi, return, pengiriman dan subscription.

---

## Tujuan Database

- Menyimpan data user dan customer
- Mengelola produk fashion beserta varian dan stok
- Mendukung proses keranjang, pesanan, pembayaran, dan pengiriman
- Mendukung fitur return, promo, wishlist, review, dan subscription

---

## Ringkasan Desain Database

- Database menggunakan konsep relasional
- Setiap tabel memiliki primary key
- Relasi antar tabel menggunakan foreign key
- Struktur database mendukung skalabilitas sistem

## Entitas Utama dan Fungsinya
# Desain Basis Data – Sistem E-Commerce (Zalora-like)

Dokumen ini menjelaskan beberapa tabel utama dalam perancangan basis data sistem e-commerce, beserta atribut, relasi, dan fungsinya. Setiap tabel dirancang untuk mendukung proses bisnis secara efisien dan terintegrasi.

---


## 1. Tabel Users  
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


## 2.


---


## 3. Tabel Produk 
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

## 4.

---

## 5.

---


## 6. Tabel Inventory  
*(Ditambahkan oleh Daris Nabil Maftuh)*

### Entitas Utama  
**Inventory (Stok Produk)**

### Atribut Utama  
- `inventory_id` (PK)  
- `variant_id` (FK)  
- `location_id` (FK)  
- `stock_qty`  
- `stock_minimum`  
- `stock_status`  
- `last_updated`  

### Relasi  
- **Inventory – Varian Produk** (1 : 1 / 1 : N)  
  Satu varian produk memiliki data stok  

- **Inventory – Lokasi Operasional** (N : 1)  
  Banyak data stok berada pada satu lokasi (gudang / toko)  

- **Inventory – Item Pesanan** (tidak langsung)  
  Stok berkurang saat terjadi transaksi pembelian  

### Fungsi  
Tabel `inventory` berfungsi untuk mengelola ketersediaan stok setiap varian produk berdasarkan lokasi penyimpanan, memantau jumlah stok, serta mendukung proses pengendalian persediaan dan transaksi penjualan.


---

## 7.

---

## 8.

---

## 9.

---

## 10.

---


## 11. Tabel Keranjang Sementara
*(Ditambahkan oleh Moh Ilham Dwinanto)*

### Deskripsi
Keranjang Sementara pada sistem e-commerce digunakan untuk menyimpan daftar produk yang dipilih oleh user sebelum dilakukan proses checkout dan pembuatan pesanan (Order). Keranjang bersifat sementara dan dapat berubah sewaktu-waktu selama user belum menyelesaikan transaksi.

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

## 12.

---

## 13. Tabel Pesanan
*(Ditambahkan oleh Syah Irkham Ramadhan)*

### Deskripsi
Tabel `Pesanan` adalah tabel transaksional utama yang mencatat setiap pembelian yang berhasil dibuat oleh pengguna. Tabel ini mengintegrasikan data dari User, Alamat Pengiriman, dan Metode Pembayaran serta menjadi induk bagi Item Pesanan.

---

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

---

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

---

### Fungsi  
Tabel `Pesanan` berfungsi sebagai: 
1. Perekam Transaksi Utama: Mencatat detail dan riwayat setiap transaksi pembelian.
2. Manajemen Status: Mengelola dan memperbarui Status pesanan dari awal hingga selesai.
3. Integrator Data: Menghubungkan semua data master (User, Alamat, Pembayaran) dengan data item produk yang dibeli.

---

### Catatan Normalisasi  
Tabel ini dirancang untuk memenuhi Third Normal Form (3NF), di mana semua atribut non-key secara langsung bergantung pada Kunci Utama `order_id`, tanpa adanya ketergantungan transitif.

---

## 14.

---


### 15. Tabel Wishlist/Favorite
*(Ditambahkan oleh Elitsa Effie)*

### Deskripsi
**Tabel wishlist** digunakan untuk menyimpan data produk yang ditandai sebagai favorit oleh pengguna dalam sistem e-commerce. Tabel ini berperan sebagai penghubung antara tabel users dan product, serta dipisahkan dari tabel keranjang karena memiliki fungsi penyimpanan minat pengguna, bukan persiapan transaksi pembelian.

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
**Tabel wishlist** menggunakan primary key tunggal dan foreign key ke tabel `users` dan `product` sehingga telah memenuhi normalisasi hingga **Third Normal Form (3NF)**. Seluruh atribut bergantung langsung pada primary key tanpa redundansi data, serta menjaga integritas data dan mendukung pengembangan fitur lanjutan.


---


## 16. Tabel Metode Pembayaran  
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


## 17. Tabel Jasa Pengiriman 
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

## Fungsi 
Tabel Jasa_Pengiriman berfungsi untuk menyimpan dan mengelola data master perusahaan ekspedisi yang digunakan dalam proses pengiriman pesanan. Tabel ini menjadi referensi utama dalam menentukan jasa pengiriman pada setiap transaksi, sehingga sistem dapat mencatat informasi pengiriman secara konsisten dan terstruktur. Selain itu, tabel ini membantu menghindari duplikasi data jasa pengiriman, memudahkan pengelolaan layanan pengiriman, serta mendukung integritas data dalam sistem informasi penjualan atau e-commerce.




---

## 18.

---

## 19.

---

## 20.

---

## 21.

---


## 22. Tabel Klaim Promo  
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


## 24.



---

## 25.## 25.Tabel Riwayat_Pencarian
(Ditambahkan oleh Eka Nurbela)

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

### Fungsi  
Tabel riwayat_pencarian berfungsi untuk mencatat dan menyimpan jejak pencarian pengguna dalam sistem e-commerce. Data dari tabel ini dapat dimanfaatkan untuk menganalisis minat dan preferensi pengguna, meningkatkan fitur rekomendasi produk, mengoptimalkan hasil pencarian, serta mendukung kebutuhan business intelligence seperti analisis tren produk yang paling sering dicari.

## Catatan
Tabel riwayat_pencarian telah dinormalisasi hingga Third Normal Form (3NF). Seluruh atribut non-kunci bergantung secara langsung pada primary key (search_id) dan tidak memiliki ketergantungan transitif. Data pengguna dan produk tidak disimpan secara redundan, melainkan direferensikan melalui foreign key (user_id dan product_id), sehingga menjaga konsistensi data dan efisiensi penyimpanan dalam sistem e-commerce.


---


## 26. Tabel Lokasi Operasional  
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

## 27.

---

## 28. Tabel Patner Company
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











