# NORMALISASI BASIS DATA  
## Tabel Return  
**Nama Mahasiswa : Fifi Nurfadillah**

---

## Atribut Awal

| Atribut        | Keterangan                                  |
|---------------|----------------------------------------------|
| return_id     | Primary Key tabel return                     |
| order_item_id | Foreign Key ke tabel item pesanan            |
| reason        | Alasan pengembalian barang                   |
| status        | Status retur (pending, approved, rejected)  |
| request_date  | Tanggal pengajuan retur                      |
| resolved_date | Tanggal penyelesaian retur                   |

---

## Proses Normalisasi

### First Normal Form (1NF)

Syarat 1NF:
- Tidak ada atribut bernilai ganda (multivalue)
- Setiap field bersifat atomik

**Analisis:**
- Semua atribut berisi satu nilai
- Tidak ada pengulangan kolom

✅ **LULUS 1NF**

---

### Second Normal Form (2NF)

Syarat 2NF:
- Sudah memenuhi 1NF
- Semua atribut non-key bergantung penuh pada Primary Key

**Analisis:**
- Primary Key: `return_id`
- Semua atribut lain (reason, status, request_date, resolved_date) bergantung langsung pada `return_id`

✅ **LULUS 2NF**

---

### Third Normal Form (3NF)

Syarat 3NF:
- Sudah memenuhi 2NF
- Tidak ada ketergantungan transitif antar atribut non-key

**Analisis:**
- Tidak ada atribut non-key yang bergantung pada atribut non-key lain
- `status` tidak menentukan tanggal, dan sebaliknya

✅ **LULUS 3NF**

---

# Keputusan Desain Database


**Alasan:**

1. **Data Return bersifat permanen**
   - Retur merupakan bagian dari riwayat transaksi
   - Dibutuhkan untuk audit, laporan, dan bukti transaksi

2. **Memiliki relasi langsung dengan tabel lain**
   - Relasi ke `Order_Item`
   - Digunakan oleh admin, customer service, dan sistem logistik

3. **Mencegah kehilangan data**
   - Jika hanya diproses di aplikasi, data akan hilang saat aplikasi ditutup atau error

4. **Mendukung tracking & histori**
   - Status retur dapat berubah (pending → approved → resolved)
   - Perubahan status harus tersimpan

5. **Sesuai prinsip normalisasi**
   - Menghindari redundansi
   - Data terstruktur dan konsisten

---

## Relasi Antar Tabel

- **Order (1) → (N) Order_Item**
- **Order_Item (1) → (0..1) Return**

---

## ERD (Sederhana)
+------------------+ +-------------------+
| Order_Item | 1 0 | Return |
+------------------+--------+-------------------+
| order_item_id(PK)| | return_id (PK) |
| order_id (FK) | | order_item_id(FK) |
| variant_id (FK) | | reason |
| quantity | | status |
| price | | request_date |
+------------------+ | resolved_date |
+-------------------+

---

## Kesimpulan

Tabel **Return**:

- ✅ Memenuhi normalisasi hingga **3NF**
- ✅ **WAJIB dijadikan tabel database**
- ❌ Tidak cukup jika hanya diproses di aplikasi
- 📌 Digunakan untuk histori, audit, dan validasi transaksi

Dengan demikian, **tabel Return harus disimpan di database**, bukan hanya sebagai proses sementara di aplikasi.

---
