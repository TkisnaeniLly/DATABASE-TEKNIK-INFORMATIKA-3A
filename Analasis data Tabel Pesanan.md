# NORMALISASI BASIS DATA -  SYAH IRKHAM RAMADHAN

**Tahap 1** : Analisis dan Normalisasi Tabel Pesanan

---

## Atribut Awal

| Atribut            | Keterangan                                  |
|--------------------|---------------------------------------------|
| Pesanan_id         | Primary Key tabel Pesanan/Order             |
| user_id            | Foreign Key ke tabel User (Pembeli)         |
| tanggal_pesanan    | Waktu pesanan dibuat/di-checkout            |
| sub_total          | Total harga item sebelum diskon/ongkir      |
| diskon             | Jumlah diskon yang diterapkan               |
| ongkos_kirim       | Biaya pengiriman                            |
| total_bayar        | Total akhir yang harus dibayar ($\text{Subtotal} - \text{Diskon} + \text{Ongkos Kirim}$)         |
| status_pesanan     | Status saat ini (Diproses, Dikirim, Selesai, Dibatalkan)         |
| alamat_kirim_id    | Foreign Key ke tabel Alamat Pengiriman         |

---

## Proses Normalisasi

### First Normal Form (1NF)
- Aturan: Tidak ada atribut multi-value atau repeating groups. Setiap field bernilai atomik.
- Analisis: Semua atribut dirancang untuk menyimpan satu nilai tunggal. Tidak ada kelompok atribut berulang dalam satu baris.

**LULUS 1NF**

---

### Second Normal Form (2NF)
- Aturan: Harus Lulus 1NF, dan semua atribut non-key harus bergantung penuh pada Primary Key ($\text{PK}$). (Relevan jika $\text{PK}$ adalah Composite Key).
- Analisis:<br> -  $\text{PK}$ tabel Pesanan adalah pesanan_id (PK tunggal).<br>
            -  Semua atribut non-key (seperti total_bayar, status_pesanan, user_id, dll.) bergantung penuh pada pesanan_id. Jika pesanan_id berubah, seluruh data                  Pesanan berubah.

**LULUS 2NF**

---

### Third Normal Form (3NF)

- Aturan: Harus Lulus 2NF, dan tidak boleh ada dependensi transitif antar atribut non-key. Artinya, tidak ada atribut non-key yang bergantung pada atribut non-key lainnya.
- Analisis:<br> - Atribut non-key seperti subtotal, diskon, ongkos_kirim, dan total_bayar semua bergantung pada pesanan_id, bukan satu sama lain.<br>
                - Detail data eksternal (misalnya detail alamat pengiriman) dipisahkan ke tabel lain dan diakses melalui Foreign Key (alamat_kirim_id), sehingga                      detail tersebut tidak melanggar 3NF di tabel Pesanan.
**LULUS 3NF**

---

## Keputusan Normalisasi

Tabel Pesanan dan Item Pesanan dipecah menjadi entitas terpisah:
1. Pesanan (Header): Menyimpan ringkasan transaksi (tanggal, total bayar, status, pembeli).
2. Item Pesanan (Detail): Menyimpan detail barang apa saja yang dibeli dalam pesanan tersebut (untuk mencegah repeating groups dan mematuhi 1NF).

---

## Relasi Antar Tabel

- **User (1) → (N) Pesanan = Satu User dapat memiliki banyak Pesanan/Transaksi historis.**
- **Pesanan (1) → (N) Item Pesanan = Satu Pesanan terdiri dari banyak Item Pesanan (Detail Barang).**
- **Pesanan (1) → (N) Alamat Pengiriman = Satu Pesanan terkait dengan satu Alamat Pengiriman spesifik saat transaksi.**

---

## ERD

```
+---------------+ 1 | N +-----------------+ 1 | N +-----------------------+ N | 1 +-----------------+
|     User      |---|---|     Pesanan     |---|---|   Item Pesanan        |---|---| Produk Variant  |
+---------------+---+---+-----------------+---+---+-----------------------+---+---+-----------------+
| user_id(PK)   |   |   | pesanan_id(PK)  |   |   | item_pesanan_id(PK)   |   |   | variant_id(PK)  |
| tipe_user     |   |   | user_id(FK)     |   |   | pesanan_id(FK)        |   |   | produk_id(FK)   |
| email         |   |   | alamat_kirim_id(FK) |   | variant_id(FK)        |   |   | nama_variant    |
| password      |   |   | tanggal_pesan   |   |   | quantity              |   |   | harga           |
| no_hp         |   |   | total_bayar     |   |   | harga_satuan_saat_itu |   |   +-----------------+
| status        |   |   | status_pesanan  |   |   | subtotal              |   |
+---------------+   |   +-----------------+   |   +-----------------------+   
                    |                         |                           
                    +--- 1 | 1 ---+           |
                                 |           |
                                 |           |
                                 |           |
                        +----------------------+
                        | Alamat Pengiriman    |
                        +----------------------+
                        | alamat_kirim_id(PK)  |
                        | user_id(FK)          |
                        | jalan                |
                        | kota                 |
                        +----------------------+
```

---

## Kesimpulan 

Tabel Pesanan dan Item Pesanan merupakan inti dari data transaksi yang bersifat historis dan permanen.
- Struktur kedua tabel memenuhi prinsip Third Normal Form (3NF).
- Pemisahan detail (Item Pesanan) dari header (Pesanan) memastikan data transaksi tidak redundan dan mudah untuk diolah, dipertahankan (integritas), serta dilaporkan.

---
