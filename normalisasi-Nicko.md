# NORMALISASI BASIS DATA – Nicko Ikhwan Prayogi

**Proyek** : Aplikasi E-Commerce
**Mata Kuliah** : Basis Data
**Tahap** : 1 – Analisis & Normalisasi

---

## Deskripsi Awal Tabel

**Item Keranjang** pada sistem e-commerce.

### Atribut Awal

| Atribut             | Keterangan                       |
| ------------------- | -------------------------------- |
| `item_keranjang_id` | Primary Key Tabel Item Keranjang |
| `keranjang_id`      | Foreign Key ke tabel Keranjang   |
| `variant_id`        | Foreign Key ke tabel variant     |
| `payment_status`    | Status pembayaran                |
| `quantity`          | jumlah item keranjang            |
| `subtotal`          | Total harga dari item            |

---

## Analisis Kebutuhan Sistem

Dalam sistem e-commerce, Tabel Item keranjang digunakan untuk:

- Menyimpan data dari Item di dalam keranjang
- menyimpan data yang hanya relevan ketika produk berada di dalam keranjang

Karena itu, data item keranjang **tidak dapat digabung langsung** dengan tabel Keranjang.

---

## Proses Normalisasi

### First Normal Form (1NF)

- Semua atribut bersifat atomik
- Tidak ada data multivalue

**Memenuhi 1NF**

---

### Second Normal Form (2NF)

- Primary Key hanya satu (`item_keranjang_id`)
- Seluruh atribut bergantung penuh pada Primary Key

**Memenuhi 2NF**

---

### Third Normal Form (3NF)

- Tidak ada dependensi transitif

**Memenuhi 3NF**

---

## Keputusan Normalisasi

### Dijadikan Tabel Tersendiri

Alasan:

1. Menyimpan Atribut Spesifik Keranjang
2. Memiliki siklus hidup dan status
3. Diperlukan untuk audit dan histori
4. fleksibilitas dan skalabilitas tabel

---

## Relasi Antar Tabel

- **Keranjang (1) → (N) Item_Keranjang**

---

## ERD (ASCII Diagram)

```
+----------------+        +------------------+        +-----------------------+
|      User      | 1    1 |    Keranjang     | 1    N | Item Keranjang        |
+----------------+--------+------------------+--------+-----------------------+
| user_id(PK)    |        | keranjang_id(PK) |        | item_keranjang_id(PK) |
| tipe_user      |        | user_id(FK)      |        | keranjang_id(FK)      |
| email          |        | total_qty        |        | variant_id(FK)        |
| password       |        | total_price      |        | quantity              |
| no_hp          |        | last_update      |        | subtotal              |
| status         |        +------------------+        +-----------------------+  
| login_terakhir |
+----------------+ 
```

---

## Kesimpulan

Tabel **Item Keranjang** wajib dijadikan tabel tersendiri karena:

- Memenuhi prinsip normalisasi hingga 3NF
- Untuk menangani relasi many-to-many antara tabel Keranjang dan tabel Produk, praktik terbaik adalah menggunakan  tabel perantara
- Mendukung audit, histori, dan skalabilitas sistem

---
