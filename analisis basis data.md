# Analisis & Perancangan Tabel Detail Pengiriman

Dokumen ini menjelaskan perancangan tabel *Detail Pengiriman* yang berfungsi menyimpan informasi spesifik mengenai proses logistik dan status pengiriman untuk setiap pesanan yang telah dibuat pada sistem e-commerce.

---

## 1. Latar Belakang Perancangan Tabel

Tabel *Detail Pengiriman* (Tabel 18) dirancang untuk memisahkan data spesifik logistik dari tabel utama *Pesanan* (Tabel 13). Pemisahan ini penting untuk menjaga 3NF dan memfokuskan tabel pesanan pada data transaksional, sementara tabel ini fokus pada data operasional pengiriman.

Perancangan tabel ini bertujuan untuk:

* Mencatat nomor resi (Tracking_Number) untuk pelacakan.
* Mencatat timeline pengiriman yang akurat (kapan dikirim dan kapan diterima).
* Menyediakan status pengiriman yang real-time kepada customer.

---

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

---

## 3. Relasi Tabel Detail Pengiriman

Tabel Detail Pengiriman adalah tabel yang sangat terikat dengan alur transaksi:

| Tabel Terkait | Jenis Relasi | Keterangan |
| :--- | :--- | :--- |
| *Pesanan* (Tabel 13) | 1 : 1 | Satu Pesanan memiliki Satu Detail Pengiriman (Order_Id FK). |
| *Jasa Pengiriman* (Tabel 17) | N : 1 | Banyak Detail Pengiriman menggunakan Satu Jenis Layanan Pengiriman (Courier_Id FK). |
| *Patner Company* (Tabel 28) | N : 1 | Secara tidak langsung, Jasa Pengiriman terkait dengan Partner Company (Logistik). |

---

## 4. Fungsi Tabel Detail Pengiriman

Tabel Detail Pengiriman berfungsi sebagai:

* *Pencatat Logistik:* Menyimpan data logistik yang spesifik untuk setiap transaksi.
* *Integrasi Kurir:* Menghubungkan sistem e-commerce dengan sistem pelacakan kurir melalui Tracking_Number dan Courier_Id.
* *Pembaruan Status:* Menjadi sumber utama informasi untuk memperbarui Pengiriman_Status yang dilihat oleh customer.

---

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

## Kesimpulan

Tabel **Detail Pengiriman** dirancang untuk memastikan pengelolaan data logistik berjalan efisien, terpusat, dan mendukung fitur pelacakan real-time. Desain ini memenuhi kaidah normalisasi hingga Third Normal Form (3NF).
