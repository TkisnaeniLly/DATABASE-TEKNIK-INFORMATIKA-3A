# Analisis & Perancangan Tabel `users`

Dokumen ini menjelaskan perancangan ulang tabel **User** dan **Customer** pada sistem e-commerce dengan konsep seperti Zalora. Kedua tabel tersebut digabung menjadi satu tabel agar struktur database lebih efisien dan tidak terjadi redundansi data.

---

## 1. Latar Belakang Penggabungan Tabel

Pada rancangan awal basis data, terdapat dua tabel terpisah yaitu **User** dan **Customer**. Namun dalam sistem e-commerce, **setiap customer pasti merupakan user** yang melakukan login dan berinteraksi dengan sistem.

Pemisahan kedua tabel tersebut berpotensi menimbulkan:

* Duplikasi data identitas
* Relasi yang tidak perlu kompleks
* Kesulitan dalam pengelolaan data user

Oleh karena itu, tabel **User** dan **Customer** digabung menjadi satu tabel bernama **`users`** untuk meningkatkan efisiensi dan konsistensi data.

---

## 2. Struktur Tabel `users`

### Nama Tabel

`users`

### Atribut Tabel

| Nama Atribut  | Keterangan                               |
| ------------- | ---------------------------------------- |
| user_id       | Primary key sebagai identitas unik user  |
| role          | Menentukan peran user (customer / admin) |
| email         | Email user untuk login                   |
| password      | Password user                            |
| phone_number  | Nomor telepon user                       |
| full_name     | Nama lengkap user                        |
| gender        | Jenis kelamin user                       |
| birth_date    | Tanggal lahir user                       |
| status        | Status akun (aktif / nonaktif)           |
| registered_at | Tanggal pendaftaran akun                 |
| last_login    | Waktu terakhir user login                |

---

## 3. Relasi Tabel `users`

Tabel `users` menjadi pusat relasi dalam sistem e-commerce dan berhubungan dengan beberapa tabel lain sebagai berikut:

| Tabel Terkait     | Jenis Relasi | Keterangan                                |
| ----------------- | ------------ | ----------------------------------------- |
| alamat_pengiriman | 1 : N        | Satu user dapat memiliki banyak alamat    |
| keranjang         | 1 : 1        | Satu user memiliki satu keranjang aktif   |
| pesanan           | 1 : N        | User dapat melakukan banyak transaksi     |
| wishlist          | 1 : N        | User dapat menyimpan produk favorit       |
| review            | 1 : N        | User dapat memberikan ulasan produk       |
| user_subscription | 1 : N        | Riwayat langganan user                    |
| klaim_promo       | 1 : N        | User dapat mengklaim promo                |
| log_aktivitas     | 1 : N        | Aktivitas user tercatat dalam sistem      |
| return            | 1 : N        | User dapat mengajukan pengembalian barang |
---

## 4. Fungsi Tabel `users`

Tabel `users` berfungsi sebagai:

* Penyimpanan data identitas pengguna
* Dasar autentikasi dan otorisasi sistem
* Penghubung utama ke seluruh aktivitas user seperti pemesanan, pembayaran, return, dan subscription

---

## 5. Analisis Normalisasi

### First Normal Form (1NF)

* Semua atribut bernilai atomik
* Tidak terdapat atribut multivalue
* Setiap record memiliki primary key

**Status: Memenuhi 1NF**

---

### Second Normal Form (2NF)

* Primary key terdiri dari satu atribut yaitu `user_id`
* Semua atribut non-key bergantung sepenuhnya pada primary key

**Status: Memenuhi 2NF**

---

### Third Normal Form (3NF)

* Tidak terdapat ketergantungan transitif
* Data alamat, transaksi, dan subscription dipisahkan ke tabel lain
* Setiap atribut hanya bergantung pada primary key

**Status: Memenuhi 3NF**

---

## Kesimpulan

Penggabungan tabel **User** dan **Customer** menjadi tabel **`users`** menghasilkan struktur database yang lebih sederhana, efisien, dan mudah dikembangkan. Desain ini mendukung kebutuhan sistem e-commerce modern serta memudahkan pengelolaan data pengguna secara terintegrasi.
