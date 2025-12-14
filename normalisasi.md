# NORMALISASI BASIS DATA - PANJI PRAMUDIA

**Tahap 1** : Analisis dan Normalisasi

---

## Atribut Awal

| Atribut            | Keterangan                                  |
|--------------------|---------------------------------------------|
| method_id          | Primary Key metode pembayaran               |
| partner_id         | Foreign Key ke tabel Partners (Penyedia)    |
| category_id        | Foreign Key ke tabel Categories (Jenis)     |
| method_name        | Nama tampilan metode                        |
| method_code        | Kode unik untuk integrasi API               |
| admin_fee_flat     | Nominal biaya admin tetap                   |
| admin_fee_percent  | Biaya admin persentase                      |
| is_active          | Status ketersediaan metode                  |

---

## Proses Normalisasi

### First Normal Form (1NF)

- Tidak ada atribut multivalue atau repeating group
- Setiap field bernilai atomik (biaya admin dipisah antara nominal dan persen)

**LULUS 1NF**

---

### Second Normal Form (2NF)

- Punya PK tunggal (`method_id`)
- Semua atribut non-key bergantung penuh ke PK

**LULUS 2NF**

---

### Third Normal Form (3NF)

- Tidak terdapat dependensi transitif antar atribut non-key
- Informasi detail penyedia (Logo, Nama PT) dipisah ke tabel `partners` agar tidak berulang

**LULUS 3NF**

---

## Keputusan Normalisasi

### Dijadikan Tabel Tersendiri

Alasan:

1. Tabel metode pembayaran berisi **konfigurasi sistem**, berbeda dengan data transaksi yang terus bertambah
2. Mencegah redundansi data penyedia layanan (Bank/E-Wallet) sehingga jika ada perubahan logo cukup ubah di satu tempat
3. Memisahkan logika biaya admin dari data historis transaksi
4. Mendukung skalabilitas sistem jika ada penambahan metode pembayaran baru di masa depan tanpa mengganggu struktur data transaksi

---

## Relasi Antar Tabel

- **Partners (1) → (N) Payment Methods**
- **Categories (1) → (N) Payment Methods**

---

## ERD (Entity Relationship Diagram)

```
+----------------+       +-----------------+       +--------------------+
|    PARTNERS    | 1   N | PAYMENT_METHODS | N   1 | PAYMENT_CATEGORIES |
+----------------+-------+-----------------+-------+--------------------+
| partner_id (PK)|       | method_id (PK)  |       | category_id (PK)   |
| name           |       | partner_id (FK) |       | name               |
| code           |       | category_id (FK)|       | slug               |
| logo_url       |       | method_name     |       +--------------------+
| is_active      |       | method_code     |
+----------------+       | admin_fee       |
                         | is_active       |
                         +-----------------+

---

## Kesimpulan 

Tabel **Metode Pembayaran** dijadikan tabel tersendiri karena:

- Memenuhi prinsip normalisasi hingga 3NF
- Mendukung fleksibilitas pengaturan biaya dan status aktif/non-aktif
- Mendukung skalabilitas sistem dan integrasi API
- Menghindari duplikasi data penyedia layanan

---
