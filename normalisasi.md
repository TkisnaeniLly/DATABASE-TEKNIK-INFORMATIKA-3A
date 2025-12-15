# NORMALISASI BASIS DATA – Apriyoda Pratama

**Proyek** : Aplikasi E-Commerce  
**Mata Kuliah** : Basis Data  
**Tahap** : Analisis & Normalisasi

---

## Deskripsi Awal Tabel

**Log Aktivitas (Activity Log)** digunakan untuk mencatat seluruh aktivitas pengguna
pada sistem e-commerce. Data ini diperlukan untuk keperluan audit,
keamanan sistem, pemantauan aktivitas pengguna, serta pelacakan kejadian
yang terjadi di dalam sistem.

---

## Atribut Tabel

| Atribut        | Keterangan                     |
| -------------- | ------------------------------ |
| `log_id`       | Primary Key log aktivitas      |
| `user_id`      | Foreign Key ke tabel User      |
| `action`       | Jenis aktivitas yang dilakukan |
| `detail`       | Detail aktivitas pengguna      |
| `tanggal_buat` | Waktu aktivitas dicatat        |

---

## Analisis Kebutuhan Sistem

Dalam sistem e-commerce:

* Satu pengguna dapat melakukan banyak aktivitas
* Aktivitas perlu dicatat untuk audit dan keamanan
* Data log bersifat historis dan tidak memengaruhi data utama

Oleh karena itu, tabel **Log Aktivitas** harus berdiri sendiri dan tidak
digabungkan dengan tabel **User** maupun tabel transaksi lainnya.

---

## Proses Normalisasi

### First Normal Form (1NF)

* Seluruh atribut bersifat atomik
* Tidak terdapat atribut bernilai ganda (multivalue)

**Kesimpulan:** Memenuhi 1NF

---

### Second Normal Form (2NF)

* Primary Key hanya terdiri dari satu atribut (`log_id`)
* Seluruh atribut non-key bergantung sepenuhnya pada primary key

**Kesimpulan:** Memenuhi 2NF

---

### Third Normal Form (3NF)

* Tidak terdapat dependensi transitif
* Informasi pengguna dipisahkan ke tabel **User**

**Kesimpulan:** Memenuhi 3NF

---

## Keputusan Normalisasi

Tabel **Log Aktivitas** dijadikan tabel terpisah karena:

1. Merupakan entitas pendukung sistem
2. Digunakan untuk audit dan keamanan
3. Menyimpan data historis
4. Menghindari redundansi data
5. Memudahkan pengelolaan dan analisis aktivitas pengguna

---

## Relasi Antar Tabel

* **User (1) → (N) Log_Aktivitas**

Satu user dapat memiliki banyak catatan log aktivitas.

---

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

---

## Kesimpulan

Tabel **Log Aktivitas** dibuat sebagai tabel terpisah karena:

* Telah memenuhi normalisasi hingga **Third Normal Form (3NF)**
* Mendukung kebutuhan audit dan keamanan sistem
* Tidak menimbulkan redundansi data
* Mendukung pengembangan sistem e-commerce di masa depan
