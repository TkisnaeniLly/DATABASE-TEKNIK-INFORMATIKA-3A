# DATABASE OVERVIEW – E-COMMERCE

Dokumen ini menjelaskan **gambaran umum database** pada website e-commerce fashion pada tabel user dan customer. Database dirancang menggunakan **basis data relasional** untuk mendukung fitur belanja, transaksi, return, pengiriman dan subscription.

---

## Tujuan Database

* Menyimpan data user dan customer
* Mengelola produk fashion beserta varian dan stok
* Mendukung proses keranjang, pesanan, pembayaran, dan pengiriman
* Mendukung fitur return, promo, wishlist, review, dan subscription

---
## Ringkasan Desain Database

* Database menggunakan konsep relasional
* Setiap tabel memiliki primary key
* Relasi antar tabel menggunakan foreign key
* Struktur database mendukung skalabilitas sistem
  
## Tabel, Entitas Utama, Relasi dan Fungsinya

## 1. Tabel Users  
*(Ditambahkan oleh Tika Isnaeni)*

### Deskripsi  
Tabel `users` merupakan hasil penggabungan antara tabel **User** dan **Customer**. Penggabungan ini dilakukan untuk meningkatkan efisiensi penyimpanan data serta menghindari redundansi. Dalam sistem e-commerce (Zalora-like), customer pada dasarnya adalah user yang telah melakukan autentikasi dan melakukan aktivitas transaksi, sehingga pemisahan tabel dianggap tidak diperlukan.

---

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

---

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

- - **users - klaim promo** (1 : N)
  Satu pengguna memiliki banyak promo yang dapat diklaim

---

### Fungsi  
Tabel `users` berfungsi sebagai pusat data pengguna dalam sistem e-commerce. Tabel ini digunakan untuk mengelola autentikasi dan otorisasi pengguna, menyimpan data profil customer, serta menjadi referensi utama bagi seluruh aktivitas pengguna seperti transaksi, subscription, pengajuan return, dan penggunaan promo. Dengan adanya tabel ini, sistem dapat mengelola data pengguna secara terintegrasi dan konsisten.

---

### Catatan Normalisasi  
Penggabungan tabel **User** dan **Customer** dilakukan untuk menjaga normalisasi data hingga **Third Normal Form (3NF)**, mengurangi duplikasi data, serta meningkatkan performa query dalam sistem e-commerce.

---

## Catatan Tambahan

* Detail SQL dan implementasi teknis disesuaikan oleh Database Engineer (Satu Kelas)
* Dokumen ini digunakan sebagai acuan konseptual dan akademik
