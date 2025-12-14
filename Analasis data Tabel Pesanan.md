# Analisis & Perancangan Tabel Pesanan

Dokumen ini menjelaskan perancangan tabel *Pesanan* yang berfungsi menyimpan data utama setiap transaksi yang telah diselesaikan oleh customer pada sistem e-commerce.

---

## 1. Latar Belakang Perancangan Tabel

Tabel *Pesanan* (Tabel 13) adalah inti dari proses transaksi. Setiap kali customer menyelesaikan proses checkout, sebuah record akan dibuat di tabel ini. Tabel ini berfungsi sebagai jembatan yang menghubungkan data customer, produk, pembayaran, dan pengiriman.

Perancangan tabel ini bertujuan untuk:

* Mencatat riwayat pembelian lengkap setiap user.
* Menentukan status pesanan saat ini (misalnya: Pending, Processing, Shipped, Delivered).
* Menyimpan ringkasan finansial (Total_Price dan Biaya_Pengiriman) dan detail Foreign Key ke entitas terkait.

---

## 2. Struktur Tabel Pesanan

### Nama Tabel

Pesanan

### Atribut Tabel

| Nama Atribut | Keterangan |
| :--- | :--- |
| Order_Id | Primary Key sebagai identitas unik setiap pesanan. |
| User_Id | Foreign Key (FK) merujuk ke tabel users (Tabel 1). Mencatat siapa yang melakukan pesanan. |
| Order_Date | Tanggal pesanan dibuat. |
| Status | Status pesanan saat ini (misalnya: Pending, Processing, Delivered). |
| Total_Price | Total harga seluruh item pesanan. |
| Biaya_Pengiriman | Biaya yang dikenakan untuk pengiriman. |
| Payment_Method_Id | Foreign Key (FK) merujuk ke tabel Metode Pembayaran (Tabel 16). |
| Address_Id | Foreign Key (FK) merujuk ke tabel Alamat Pengiriman (Tabel 2). Mencatat alamat tujuan. |
| Tracking_Number | Nomor pelacakan (residu) yang diberikan oleh jasa pengiriman. |
| Created_At | Waktu record pesanan ini dibuat. |

---

## 3. Relasi Tabel Pesanan

Tabel Pesanan memiliki banyak relasi sebagai penghubung utama transaksi:

| Tabel Terkait | Jenis Relasi | Keterangan |
| :--- | :--- | :--- |
| *users* (Tabel 1) | N : 1 | Banyak Pesanan dimiliki oleh Satu User (User_Id FK). |
| *Alamat Pengiriman* (Tabel 2) | N : 1 | Banyak Pesanan dapat menggunakan Satu Alamat Pengiriman yang tersimpan di profil user (Address_Id FK). |
| *Metode Pembayaran* (Tabel 16) | N : 1 | Banyak Pesanan dapat menggunakan Satu Jenis Metode Pembayaran (Payment_Method_Id FK). |
| *Item Pesanan* (Tabel 14) | 1 : N | Satu Pesanan terdiri dari banyak Item Pesanan (produk/varian). |
| *Detail Pengiriman* (Tabel 18) | 1 : 1 | Satu Pesanan memiliki satu Detail Pengiriman yang mencatat info kurir, waktu kirim, dan status pengiriman. |
| *Detail Pembayaran* (Tabel 19) | 1 : 1 | Satu Pesanan memiliki satu Detail Pembayaran yang mencatat status lunas, waktu bayar, dan referensi transaksi. |
| *Klaim Promo* (Tabel 22)
