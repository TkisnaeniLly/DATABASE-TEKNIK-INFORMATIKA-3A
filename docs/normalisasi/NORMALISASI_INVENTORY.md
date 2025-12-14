# NORMALISASI TABEL INVENTORY / STOK

## Entitas Utama
Inventory adalah entitas utama yang menyimpan data stok produk berdasarkan varian dan lokasi.

## Atribut
- inventory_id (PK)
- variant_id (FK)
- location_id (FK)
- stock_qty
- stock_minimum
- stock_status
- last_updated

## Relasi Antar Tabel
Inventory berelasi dengan tabel Varian dan Lokasi Operasional.

## Normalisasi
Tabel Inventory memenuhi Third Normal Form (3NF).

## Penggabungan Tabel
Tabel Inventory tidak digabungkan dengan tabel lain untuk menghindari redundansi data.
