# NORMALISASI BASIS DATA - RIYAN ZACKI SAPUTRA

**Tahap 1** : Analisis dan NORMALISASI

---

## Atribut Awal

| Atribut            | Keterangan                                      |
|--------------------|-------------------------------------------------|
| Order_Item_Id      | Primary Key item pesanan                        |
| Order_Id           | Foreign Key ke tabel Pesanan                    |
| Variant_Id         | Foreign Key ke ytabel Varian                    |
| Quantity           | Jumlah barang yang dibeli untuk varian tersebut |
| Price       nnnn   | Harga satuan barang saat transaksi terjadi      |

---

## Proses Normalisasi

---

### Frist Normal From (1NF)

Syarat:
- Semua atribut bersifat atomik (tidak bisa dipecah lagi).
- Tidak ada repeating group atau data multivalue.
Analisis: Setiap baris hanya memuat satu varian produk untuk satu pesanan tertentu.
- Status: Memenuhi 1NF

---

### Second Normal Form (2NF)
Syarat:
- Sudah memenuhi 1NF.
- Tidak ada ketergantungan parsial (atribut non-key bergantung penuh pada Primary Key).
Analisis: Primary Key adalah Order_Item_Id.
- Quantity bergantung penuh pada item spesifik ini.
- Price bergantung pada kesepakatan harga saat item ini dibuat (bukan hanya tergantung pada varian aslinya).
- Tidak ada atribut yang hanya bergantung sebagian pada PK.
- Status: Memenuhi 2NF

---

### Third Normal Form (3NF)
Syarat:
- Sudah memenuhi 2NF.
- Tidak ada dependensi transitif (atribut non-key tidak boleh bergantung pada atribut non-key lainnya).
Analisis:
- Order_Id dan Variant_Id adalah Foreign Key yang valid.
- Price: Meskipun harga ada di Tabel Varian, Price di tabel ini adalah harga kesepakatan/histori. Ia bergantung langsung pada kejadian pemesanan (Order_Item_Id), bukan sekadar salinan dari Tabel Varian.
- Tidak ada atribut deskriptif lain (seperti Nama Produk) yang disimpan di sini (sudah benar, karena nama ada di tabel master).
- Status: Memenuhi 3NF

---

## Keputusan Normalisasi
Dijadikan Tabel Tersendiri (Tabel Pivot)
Alasan:
- Menangani relasi Many-to-Many antara Pesanan dan Varian.
- Memisahkan data Header (Total harga, kurir, alamat di Tabel Pesanan) dengan data Detail (Barang A, Barang B di Tabel Item Pesanan).
- Menjaga integritas data histori harga jual.
- Memudahkan perhitungan statistik penjualan per item/varian.

---

## Relasi Antar Tabel
- Tabel Pesanan (1) → (N) Tabel Item Pesanan
- Tabel Varian (1) → (N) Tabel Item Pesanan

## ERD

```
+----------------+        +------------------+        +-----------------------+
|      PESANAN   | 1    N |    ITEM PESANAN  | N    1 |         VARIAN        |
+----------------+--------+------------------+--------+-----------------------+
| Order_Id PK    |        | Order_Item_Id PK |        | Varian_Id             |
| User_Id        |        | Order_Id FK      |        | Product_Id            |
| Total_Price    |        | Varian_Id FK     |        | Size                  |
| Status         |        | Quantity         |        | Color                 |
+----------------+        | Price (History)  |        +-----------------------+
                          +------------------+        
 
```

---

## Kesimpulan
Tabel Item Pesanan sudah berada dalam bentuk normal ketiga (3NF) dan struktur ini sangat krusial dalam basis data e-commerce untuk menangani detail transaksi tanpa melanggar aturan normalisasi.
