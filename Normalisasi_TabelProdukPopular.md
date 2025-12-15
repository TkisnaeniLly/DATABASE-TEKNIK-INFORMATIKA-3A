# NORMALISASI BASIS DATA – SAE AL CHAQ

**Tabel** : Produk Popular / Pencarian Popular  

---

## Deskripsi Awal Tabel

Tabel **Produk Popular / Pencarian Popular** digunakan untuk menyimpan data produk yang sering dicari atau memiliki tingkat popularitas tinggi pada periode tertentu di sistem e-commerce.

### Atribut Awal

| Atribut    | Keterangan                                  |
|------------|----------------------------------------------|
| popular_id | Primary Key data popular                     |
| product_id | Foreign Key ke tabel Product                 |
| keyword    | Kata kunci pencarian                         |
| score      | Nilai popularitas                            |
| period     | Periode popularitas (Daily/Weekly/Monthly)   |

---

## Analisis Kebutuhan Sistem

Dalam sistem e-commerce:

* Satu produk dapat muncul sebagai produk populer pada lebih dari satu periode
* Popularitas bersifat **time-based (berdasarkan waktu)**
* Digunakan untuk fitur rekomendasi dan analitik
* Data bersifat historis dan perlu disimpan

Artinya, data popular **bukan data sementara** dan tidak cukup jika hanya dihitung di aplikasi.

---

## Proses Normalisasi

### First Normal Form (1NF)

* Semua atribut bernilai atomik
* Tidak ada atribut multivalue atau repeating group

**Memenuhi 1NF**

---

### Second Normal Form (2NF)

* Memiliki Primary Key tunggal (`popular_id`)
* Seluruh atribut non-key bergantung penuh pada Primary Key

**Memenuhi 2NF**

---

### Third Normal Form (3NF)

* Tidak terdapat dependensi transitif
* Informasi produk dipisahkan ke tabel Product
* Data popular hanya menyimpan referensi produk dan metrik popularitas

**Memenuhi 3NF**

---

## Keputusan Normalisasi

### Wajib Dijadikan Tabel di Database

**Tabel Produk Popular / Pencarian Popular harus menjadi tabel tersendiri di database**, bukan hanya diproses di aplikasi.

### Alasan Utama

1. Data digunakan lintas fitur (home, search, rekomendasi)
2. Bersifat historis dan analitik
3. Menghindari perhitungan ulang yang mahal
4. Tidak mencampur data analitik dengan data transaksi
5. Mendukung pengembangan sistem ke depan

---

## Koreksi & Keterkaitan dengan 28 Tabel Lain

### Tabel yang Berkaitan Langsung

| Tabel      | Relasi         | Keterangan                                    |
|------------|----------------|-----------------------------------------------|
| Product    | 1 → N          | Satu produk dapat populer di banyak periode   |
| Order_Item | Tidak langsung | Penjualan memengaruhi skor popular            |
| Review     | Tidak langsung | Rating memengaruhi popularitas                |

---

### Tabel yang **TIDAK BOLEH DIGABUNG**

| Tabel            | Alasan                                       |
|------------------|----------------------------------------------|
| Product          | Popularitas bersifat temporal                |
| Order            | Order adalah data transaksi                  |
| Riwayat Pencarian| Bersifat individual per user                 |

---

### Apakah Ada Tabel yang Sama atau Duplikat?

**Tidak ada tabel lain yang memiliki fungsi sama** dengan tabel Produk Popular.

Perbedaan utama:

* **Riwayat Pencarian** → data per user
* **Produk Popular** → data agregat sistem

---

## Relasi Antar Tabel (ASCII)

```text
+----------------------+        +------------------------------+
|       PRODUCT        | 1    N |     PRODUK_POPULAR           |
+----------------------+--------+------------------------------+
| PK product_id        |        | PK popular_id                |
| nama_produk          |        | FK product_id                |
| status               |        | keyword                      |
+----------------------+        | score                        |
                                | period                       |
                                +------------------------------+
