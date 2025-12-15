# NORMALISASI TABEL INVENTORY / STOK

## 1. Entitas Utama
Inventory merupakan entitas utama yang berfungsi menyimpan data stok produk berdasarkan varian dan lokasi penyimpanan. Tabel ini berperan penting dalam mengontrol ketersediaan barang pada sistem e-commerce.

---

## 2. Atribut
Tabel Inventory memiliki atribut sebagai berikut:
- inventory_id (PK)
- variant_id (FK)
- location_id (FK)
- stock_qty
- stock_minimum
- stock_status
- last_updated

Setiap atribut memiliki fungsi spesifik dan tidak saling bergantung secara transitif.

---

## 3. Relasi Antar Tabel
Relasi tabel Inventory dengan tabel lain adalah:
- Inventory berelasi dengan tabel Varian melalui atribut variant_id.
- Inventory berelasi dengan tabel Lokasi Operasional melalui atribut location_id.

Relasi ini memungkinkan pengelolaan stok berdasarkan varian produk dan lokasi penyimpanan (gudang/toko).

---

## 4. ERD (Entity Relationship Diagram)

Berikut gambaran ERD sederhana untuk tabel Inventory:

+-------------------+      1        N      +-------------------+
|      Varian       |-------------------->|     Inventory     |
+-------------------+                     +-------------------+
| variant_id (PK)   |                     | inventory_id (PK) |
| product_id (FK)   |                     | variant_id (FK)   |
| nama_varian       |                     | location_id (FK)  |
| harga             |                     | stock_qty         |
+-------------------+                     | stock_minimum     |
                                          | stock_status      |
                                          | last_updated      |
                                          +-------------------+
                                                    |
                                                    | N
                                                    |
                                                    | 1
                                          +----------------------+
                                          | Lokasi Operasional   |
                                          +----------------------+
                                          | location_id (PK)     |
                                          | nama_lokasi          |
                                          | tipe_lokasi          |
                                          +----------------------+

Diagram ini menunjukkan bahwa satu varian dapat memiliki banyak data inventory,
dan satu lokasi operasional dapat menyimpan banyak data inventory.

---

## 5. Keputusan Normalisasi
Berdasarkan analisis normalisasi:
- Tabel Inventory **tidak digabungkan** dengan tabel Varian maupun Produk.
- Pemisahan tabel dilakukan untuk menghindari redundansi data dan menjaga konsistensi stok.
- Tabel Inventory berdiri sendiri sebagai tabel transaksi stok dan memenuhi prinsip **Third Normal Form (3NF)**.

Keputusan ini mendukung sistem agar lebih fleksibel jika dikembangkan menjadi multi-gudang.

---

## 6. Kesimpulan
Tabel Inventory dirancang sebagai entitas mandiri untuk mengelola data stok secara akurat dan efisien. Dengan penerapan normalisasi hingga 3NF, struktur tabel menjadi lebih rapi, mudah dikembangkan, serta mendukung integritas data dalam proses transaksi dan manajemen persediaan.



