# NORMALISASI BASIS DATA – SAE AL CHAQ

**Tabel** : Alamat Pengiriman

---

## Deskripsi Awal Tabel

Tabel **Alamat Pengiriman** digunakan untuk menyimpan informasi alamat tujuan pengiriman barang pada sistem e-commerce.

### Atribut Tabel

| Atribut       | Keterangan                    |
| ------------- | ----------------------------- |
| address_id    | Primary Key alamat            |
| customer_id   | Foreign Key ke tabel Customer |
| label         | Penanda alamat (Rumah/Kantor) |
| nama_penerima | Nama penerima paket           |
| telepon       | Nomor telepon penerima        |
| alamat        | Detail alamat jalan           |
| provinsi      | Provinsi tujuan               |
| kota          | Kota tujuan                   |
| kecamatan     | Kecamatan tujuan              |
| kode_pos      | Kode pos                      |
| is_default    | Penanda alamat utama          |
| dibuat_pada   | Waktu pembuatan alamat        |

---

## Analisis Kebutuhan Sistem

Dalam sistem e-commerce:

* Satu customer **dapat memiliki lebih dari satu alamat pengiriman**
* Alamat **digunakan berulang** untuk banyak pesanan
* Alamat harus tetap tersimpan walaupun pesanan selesai
* Alamat berpengaruh langsung ke proses logistik dan pengiriman

Artinya, alamat **bukan data sementara**, melainkan **data master milik customer**.

---

## Proses Normalisasi

### First Normal Form (1NF)

* Semua atribut bersifat atomik
* Tidak ada atribut multivalue

**Memenuhi 1NF**

---

### Second Normal Form (2NF)

* Primary Key tunggal (`address_id`)
* Seluruh atribut bergantung penuh pada Primary Key

**Memenuhi 2NF**

---

### Third Normal Form (3NF)

* Tidak terdapat dependensi transitif
* Data customer dipisah ke tabel Customer

**Memenuhi 3NF**

---

## Keputusan Normalisasi

### ✅ Wajib Dijadikan Tabel di Database

**Tabel Alamat Pengiriman harus menjadi tabel tersendiri di database**, bukan hanya diproses di aplikasi.

### Alasan Utama

1. Alamat merupakan **entitas bisnis**
2. Digunakan oleh banyak transaksi (Order)
3. Bersifat permanen dan berulang
4. Mencegah pengulangan alamat di tabel Order
5. Mendukung histori dan audit

---

## Koreksi & Keterkaitan dengan 28 Tabel Lain

### Tabel yang Berkaitan Langsung

| Tabel             | Relasi         | Keterangan                        |
| ----------------- | -------------- | --------------------------------- |
| Customer          | 1 → N          | Satu customer punya banyak alamat |
| Order             | 1 → 1          | Order menggunakan satu alamat     |
| Detail Pengiriman | 1 → 1          | Menggunakan alamat tujuan         |
| Jasa Pengiriman   | Tidak langsung | Estimasi dan rute pengiriman      |

---

### Tabel yang **TIDAK BOLEH DIGABUNG**

| Tabel             | Alasan                            |
| ----------------- | --------------------------------- |
| Order             | Menghindari redundansi alamat     |
| Customer          | Customer bisa punya banyak alamat |
| Detail Pengiriman | Fokus ke status & tracking        |

---

### Apakah Ada Tabel yang Sama atau Duplikat?

❌ **Tidak ada tabel lain yang memiliki fungsi sama** dengan Tabel Alamat Pengiriman.

Namun:

* Tabel **Lokasi Operasional** ➜ alamat internal perusahaan
* Tabel **Detail Pengiriman** ➜ status & proses pengiriman

📌 **Ketiganya berbeda fungsi dan tidak boleh disatukan**.

---

## Relasi Antar Tabel (Ringkas)

```
Customer (1) ──── (N) Alamat_Pengiriman
                      │
                      │ (1)
                      ▼
                   Order
```

---

## Kesalahan Desain yang Harus Dihindari

❌ Menyimpan alamat langsung di tabel Order
❌ Mengelola alamat hanya sebagai object di aplikasi
❌ Menyimpan alamat berulang di setiap transaksi

Dampak:

* Data ganda
* Sulit update alamat
* Tidak konsisten

---

## Kesimpulan

### Jawaban Final

> **Tabel Alamat Pengiriman WAJIB dijadikan tabel di database**.

### Ringkasan

* Memenuhi prinsip normalisasi hingga 3NF
* Tidak tumpang tindih dengan 28 tabel lain
* Memiliki relasi jelas dan terpisah
* Tidak boleh digantikan oleh logic aplikasi

---
