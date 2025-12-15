NORMALISASI BASIS DATA – Virgiawan Ananda Purwoko

*Proyek** : Aplikasi E-Commerce
**Mata Kuliah** : Basis Data
**Tahap** : 1 – Analisis & Normalisasi

---

## Deskripsi Awal Tabel

**Detail Promosi** pada sistem e-commerce.

### Atribut Awal

| Atribut             | Keterangan                           |
| ------------------- | ------------------------------------          |
| `promo_id`          | ID unik promo (primary key)                   |
| `kode_promo`        | Kode promo yang digunakan pengguna            |
| `nama_promo`        | Nama atau judul promo                         |
| `jenis_diskon`      | Jenis diskon (persentase / nominal)           |
| `nilai_diskon`      | Besar diskon yang diberikan                   |
| `tanggal_mulai`     | Tanggal mulai promo berlaku                   |
| `tanggal_akhir`     | Tanggal promo berakhir                        |
| `minimal_transaksi` | Minimum nilai transaksi agar promo aktif      |
| `maksimal_diskon`   | Batas maksimum potongan (jika persen)         |
| `kuota`             | Jumlah maksimal penggunaan promo              |
| `status`            | Status promo (aktif / nonaktif / kadaluarsa)  |
| `keterangan`        | Penjelasan atau syarat tambahan promo         |

---

## Analisis Kebutuhan Sistem

Dalam sistem e-commerce, promo memiliki karakteristik:

- Tidak selalu berlaku untuk semua transaksi
- Memiliki periode waktu tertentu (mulai dan berakhir)
- Dapat memiliki berbagai jenis dan aturan (persentase, nominal, syarat minimal)
- Memerlukan pengelolaan status (aktif, nonaktif, kadaluarsa)
- Dapat digunakan pada lebih dari satu pesanan (Order)

Karena itu, data promo tidak dapat digabung langsung dengan tabel Order dan perlu dikelola dalam tabel tersendiri.

---

## Proses Normalisasi

### First Normal Form (1NF)

- Semua atribut bersifat atomik
- Tidak ada data multivalue (satu kolom satu nilai)

  **Memenuhi 1NF**

  ---

  ### Second Normal Form (2NF)

- Primary Key hanya satu (promo_id)
- Seluruh atribut bergantung penuh pada Primary Key

**Memenuhi 2NF**

 ---

 ### Third Normal Form (3NF)

- Tidak terdapat ketergantungan transitif
- Setiap atribut non-primary tidak bergantung pada atribut non-primary lainnya

  **Memenuhi 3NF**

  ---

  ## Keputusan Normalisasi

  ### Dijadikan Tabel Tersendiri

  Alasan:

1. Promo merupakan entitas bisnis, bukan sekadar atribut tambahan
2. Memiliki periode berlaku dan status yang jelas
3. Dapat digunakan pada lebih dari satu transaksi (Order)
4. Menghindari redundansi data pada tabel Order
5. Mendukung pengelolaan dan pengembangan promo di masa depan

---

## Relasi Antar Tabel

- Promo (1) → (N) Klaim_Promo
- User (1) → (N) Klaim_Promo
- Promo (1) → (N) Order

---

## ERD 

```
+-------------+     1     N     +----------------+     N     1     +-------------+
|   PROMO     |--------------- |  KLAIM_PROMO   |--------------- |    USER     |
+-------------+                 +----------------+                 +-------------+
| promo_idPK  |                 | klaim_idPK     |                 | user_idPK   |
| kode_promo  |                 | promo_idFK     |                 | name        |
| jenis_diskon|                 | user_idFK      |                 | email       |
| nilai_diskon|                 | used_at        |                 |             |
| start_date  |                 | status         |                 |             |
| end_date    |                 +----------------+                 +-------------+
| status      |
+-------------+

           1
           |
           |
           N
     +-------------+
     |   ORDER     |
     +-------------+
     | order_idPK  |
     | user_idFK   |
     | promo_idFK  |
     | order_date  |
     | total_price |
     +-------------+

```

---

## Perbandingan dengan Tabel Mahasiswa Lain

|  Mahasiswa   |  Tabel       |                          Konsistensi                                           |     |
| ----------   | -----------  | ------------------------------------------------------------------------------ | --- |
| User         | Customer     | Promo dapat dibatasi per pengguna atau segmen tertentu (melalui klaim promo).  | ✔️  |
| Produk       | Product      | Promo dapat berlaku untuk produk, kategori, atau brand tertentu.               | ✔️  |
| Order        | Pesanan      | Promo diterapkan pada saat checkout dan tercatat pada data pesanan.            | ✔️  |
| Klaim Promo  | Ambil Promo  | Menyimpan riwayat penggunaan promo oleh pengguna serta kontrol kuota.          | ✔️  |
| Subscription | Berlangganan | Promo diterapkan pada saat checkout dan tercatat pada data pesanan.            | ✔️  |
| **Virgi**    | Promo        | Menyimpan aturan diskon secara terpisah dari transaksi.                        | ✔️  |

Struktur Promo **selaras dan konsisten** dengan tabel mahasiswa lain.

## Kesimpulan

- Memenuhi prinsip normalisasi hingga 3NF
- Mewakili entitas bisnis promo secara mandiri
- Mendukung pengelolaan aturan diskon, periode berlaku, dan status promo
- Menghindari redundansi data pada tabel pesanan
- Mendukung pengembangan dan skalabilitas sistem promo di masa depan

---
