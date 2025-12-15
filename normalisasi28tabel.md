# 📌 Tabel Tambahan Database

Tabel yang mungkin bisa ditambahkan dengan tujuan meningkatkan **normalisasi**, **fleksibilitas**, dan **skalabilitas sistem**.

---

## 1️⃣ Tabel `product_attributes`

### Fungsi

Menyimpan **jenis atribut produk** sebagai data master (contoh: Warna, Ukuran, Material).

### Struktur Tabel

| Field             | Keterangan                           |
| ----------------- | ------------------------------------ |
| attribute_id (PK) | ID unik atribut                      |
| name              | Nama atribut (Color, Size, Material) |
| input_type        | Jenis input (select, radio, text)    |
| is_active         | Status atribut                       |

### Alasan Penambahan

- Menghindari atribut produk yang bersifat hardcoded
- Memudahkan penambahan atribut baru tanpa perubahan struktur tabel
- Mendukung filter produk yang dinamis
- Menjaga database tetap dalam bentuk normal ke-3 (3NF)

---

## 2️⃣ Tabel `attribute_values`

### Fungsi

Menyimpan **nilai dari setiap atribut produk**.

### Struktur Tabel

| Field             | Keterangan                        |
| ----------------- | --------------------------------- |
| value_id (PK)     | ID nilai atribut                  |
| attribute_id (FK) | Relasi ke product_attributes      |
| value             | Nilai atribut (Merah, XL, Cotton) |
| sort_order        | Urutan tampilan                   |

### Alasan Penambahan

- Menghindari input nilai atribut bebas (free text)
- Memudahkan indexing dan pencarian data
- Menjaga konsistensi nilai atribut produk

---

## 3️⃣ Tabel `variant_attribute_map`

### Fungsi

Sebagai **tabel penghubung (pivot)** antara varian produk dan nilai atribut.

### Struktur Tabel

| Field           | Keterangan       |
| --------------- | ---------------- |
| variant_id (FK) | ID varian produk |
| value_id (FK)   | ID nilai atribut |

### Alasan Penambahan

- Mendukung relasi Many-to-Many antara varian dan atribut
- Satu varian dapat memiliki lebih dari satu atribut
- Struktur lebih fleksibel dibanding kolom statis

---

## 4️⃣ Tabel `couriers`

### Fungsi

Menyimpan **data master ekspedisi pengiriman**.

### Struktur Tabel

| Field           | Keterangan                         |
| --------------- | ---------------------------------- |
| courier_id (PK) | ID ekspedisi                       |
| name            | Nama ekspedisi (JNE, J&T, SiCepat) |
| logo_url        | Logo ekspedisi                     |
| status          | Aktif / Nonaktif                   |

### Alasan Penambahan

- Memisahkan data ekspedisi dari layanan pengiriman
- Menghindari duplikasi nama ekspedisi
- Mendukung penambahan ekspedisi baru

---

## 5️⃣ Tabel `courier_services`

### Fungsi

Menyimpan **jenis layanan pengiriman** dari setiap ekspedisi.

### Struktur Tabel

| Field           | Keterangan                      |
| --------------- | ------------------------------- |
| service_id (PK) | ID layanan                      |
| courier_id (FK) | Relasi ke couriers              |
| service_code    | REG / YES / ECO                 |
| estimasi_days   | Estimasi lama pengiriman (hari) |
| cost_type       | Flat / Dynamic                  |
| status          | Aktif / Nonaktif                |

### Alasan Penambahan

- Satu ekspedisi memiliki banyak layanan
- Estimasi dan biaya berbeda tiap layanan
- Digunakan oleh tabel detail_pengiriman

---

## 6️⃣ Tabel `promo_products`

### Fungsi

Menghubungkan **promo dengan produk tertentu**.

### Struktur Tabel

| Field           | Keterangan |
| --------------- | ---------- |
| promo_id (FK)   | ID promo   |
| product_id (FK) | ID produk  |

### Alasan Penambahan

- Mendukung promo yang hanya berlaku untuk produk tertentu
- Menghindari logika promo di level aplikasi
- Struktur lebih fleksibel

---

## 7️⃣ Tabel `promo_categories`

### Fungsi

Menghubungkan **promo dengan kategori produk**.

### Struktur Tabel

| Field            | Keterangan  |
| ---------------- | ----------- |
| promo_id (FK)    | ID promo    |
| category_id (FK) | ID kategori |

### Alasan Penambahan

- Promo dapat diterapkan ke banyak kategori
- Struktur database tetap rapi dan terkontrol

---

## 8️⃣ Tabel `promo_brands`

### Fungsi

Menghubungkan **promo dengan brand tertentu**.

### Struktur Tabel

| Field         | Keterangan |
| ------------- | ---------- |
| promo_id (FK) | ID promo   |
| brand_id (FK) | ID brand   |

### Alasan Penambahan

- Mendukung promo khusus brand tertentu
- Fleksibel untuk kerja sama dengan brand partner

---

## 📊 Ringkasan Tabel Tambahan

| Area Sistem    | Tabel                 |
| -------------- | --------------------- |
| Atribut Produk | product_attributes    |
|                | attribute_values      |
|                | variant_attribute_map |
| Logistik       | couriers              |
|                | courier_services      |
| Promo          | promo_products        |
|                | promo_categories      |
|                | promo_brands          |

---

## 🧾 Kesimpulan

Penambahan tabel-tabel ini:

- Tidak menghapus tabel lama
- Meningkatkan normalisasi database
- Membuat sistem lebih scalable dan fleksibel
- Layak digunakan untuk kebutuhan akademik maupun implementasi nyata
