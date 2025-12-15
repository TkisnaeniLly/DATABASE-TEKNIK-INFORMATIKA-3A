# NORMALISASI BASIS DATA – FAWWAZ ARDIANSYAH

**Objek Normalisasi** : Tabel Kategori

---

## Pertanyaan Utama

Apakah hasil normalisasi tabel **Kategori** harus dijadikan **tabel fisik di database**, atau cukup **diproses di dalam aplikasi saja**?

---

## Atribut Awal

| Atribut       | Keterangan                  |
| ------------- | --------------------------- |
| category_id   | Primary Key kategori        |
| product_id    | Foreign Key ke tabel Produk |
| category_name | Nama kategori produk        |
| icon_url      | Icon / gambar kategori      |

---

## Proses Normalisasi

### First Normal Form (1NF)

* Semua atribut bernilai atomik
* Tidak ada data berulang dalam satu kolom

**LULUS 1NF**

---

### Second Normal Form (2NF)

* Primary Key menggunakan `category_id`
* Semua atribut non-key bergantung penuh pada PK

**LULUS 2NF**

---

### Third Normal Form (3NF)

* Tidak ada ketergantungan transitif
* `category_name` dan `icon_url` hanya bergantung pada `category_id`

**LULUS 3NF**

---

## Analisis Desain

### Masalah Desain Awal

Jika `category_id`, `category_name`, dan `icon_url` disimpan berulang di banyak baris produk:

* Terjadi **redundansi data**
* Update nama/icon kategori harus dilakukan di banyak record
* Risiko **inkonsistensi data**

---

## Keputusan Normalisasi

### **WAJIB dijadikan Tabel di Database**

❌ **Tidak disarankan** hanya diproses di aplikasi

✅ **Disarankan kuat** menjadi tabel fisik di database

### Alasan:

1. **Kategori adalah data master**
2. Digunakan oleh banyak produk (relasi 1 ke N)
3. Jarang berubah tapi sering dibaca
4. Lebih aman, konsisten, dan efisien
5. Memenuhi prinsip normalisasi hingga 3NF

---

## Desain Tabel Hasil Normalisasi

### Tabel Kategori

| Field         | Keterangan    |
| ------------- | ------------- |
| category_id   | Primary Key   |
| category_name | Nama kategori |
| icon_url      | Icon kategori |

### Tabel Produk

| Field       | Keterangan              |
| ----------- | ----------------------- |
| product_id  | Primary Key             |
| category_id | Foreign Key ke Kategori |
| nama_produk | Nama produk             |
| deskripsi   | Deskripsi produk        |

---

## Relasi Antar Tabel

* **Kategori (1) → (N) Produk**

---

## ERD

```
+-------------------+       +------------------+
|     Kategori      | 1   N |      Produk      |
+-------------------+-------+------------------+
| category_id (PK)  |       | product_id (PK)  |
| category_name     |       | category_id (FK) |
| icon_url          |       | nama_produk      |
+-------------------+       +------------------+
```

---

## Kesimpulan

Normalisasi tabel **Kategori**:

* **Tidak cukup** hanya diproses di aplikasi
* **Harus dibuat sebagai tabel tersendiri di database**
* Menjaga konsistensi data
* Menghindari redundansi
* Mendukung skalabilitas dan maintenance jangka panjang

---

📌 **Catatan Dosen Style**:

> Selama data bersifat *master* dan dipakai lintas transaksi, maka hasil normalisasi **WAJIB** diwujudkan dalam bentuk tabel di database, bukan hanya logika aplikasi.
