# NORMALISASI BASIS DATA – Piejar Annisa Berlianti 24225018

**Proyek** : Aplikasi E-Commerce
**Mata Kuliah** : Basis Data
**Tahap** : 1 – Analisis & Normalisasi

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

---

###Second Normal Form (2NF)
**Syarat:** Harus memenuhi 1NF, dan semua atribut non-kunci harus bergantung penuh pada seluruh *Primary Key*. (Ini relevan jika PK adalah kunci gabungan/komposit).

* **Tindakan:** *Primary Key* kita adalah `user_subsc_id` (kunci tunggal/sederhana).
* Kolom non-kunci (`start_date`, `end_date`, `status`, `subs_id`, `user_id`) semuanya bergantung langsung dan penuh pada `user_subsc_id`.
* Jika `subs_id` (misalnya, *Nama Paket*) ada di sini, itu akan melanggar 2NF (karena *Nama Paket* bergantung pada `subs_id`, yang hanya bagian dari PK jika kita menggunakan PK gabungan). Karena `subs_id` sudah menjadi Foreign Key yang merujuk ke tabel master `subscriptions`, maka 2NF terpenuhi.


* **Kesimpulan:** Struktur tabel **Memenuhi 2NF**.

---

###Third Normal Form (3NF)
**Syarat:** Harus memenuhi 2NF, dan tidak boleh ada ketergantungan transitif (kolom non-kunci tidak boleh bergantung pada kolom non-kunci lainnya).

* **Contoh Pelanggaran (Jika Ada):** Jika kita memasukkan `subscription_name` (nama paket, kolom non-kunci) langsung ke tabel ini, maka `subscription_name` bergantung pada `subs_id` (kolom non-kunci). Ini akan melanggar 3NF.
* **Tindakan:** Karena `subscription_name` dan detail paket lainnya (`price`, `duration`) sudah dipisahkan ke tabel master **`subscriptions`** dan hanya direferensikan melalui `subs_id` (Foreign Key), maka tidak ada ketergantungan transitif di tabel `user_subscriptions`.
* **Kesimpulan:** Struktur tabel **Memenuhi 3NF**.

---

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

---

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