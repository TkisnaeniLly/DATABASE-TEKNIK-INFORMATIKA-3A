# NORMALISASI BASIS DATA -  MOH ILHAM DWINANTO

**Tahap 1** : Analisis dan Normalisasi 

---

## Atribut Awal

| Atribut            | Keterangan                                  |
|--------------------|---------------------------------------------|
| keranjang_id       | Primary Key keranjang                       |
| user_id            | Foreign Key ke tabel User                   |
| total_qty          | Total jumlah item dalam keranjang           |
| total_price        | Total harga seluruh item                    |
| last_update        | Waktu terakhir keranjang diperbarui         |

---

## Proses Normalisasi

### First Normal Form (1NF)

- Tidak ada atribut multivalue atau repeating 
- Setiap field bernilai atomik

**LULUS 1NF**

---

### Second Normal Form (2NF)

- Punya PK tunggal (`keranjang_id`)
- Semua atribut non-key bergantung penuh ke PK

**LULUS 2NF**

---

### Third Normal Form (3NF)

- Tidak terdapat dependensi transitif antar atribut non-key
- Atribut `total_qty` dan `total_price` bukan bergantung pada atribut lain dalam tabel yang sama

**LULUS 3NF**

---

## Keputusan Normalisasi

### Dijadikan Tabel Tersendiri

Alasan:

1. Tabel keranjang memiliki siklus hidup yaitu diperbarui, dihapus, maupun diubah menjadi order
2. Mencegah redundansi dan kekacauan data sehingga data rapi dan mudah dihapus tanpa mengganggu transaksi lain
3. Tabel keranjang sebagai pembatas serta menjadi yang membedakan antara belum transaksi (data sementara) dan sudah transaksi (data final)
4. Mendukung skalabilitas sistem seperti sinkronisasi multi device, menyimpan data keranjang walau user logout

---

## Relasi Antar Tabel

- **User (1) → (1) Keranjang**
- **Keranjang (1) → (N) Item Keranjang**

---

## ERD

```
+----------------+        +------------------+        +-----------------------+
|      User      | 1    1 |    Keranjang     | 1    N | Item Keranjang        |
+----------------+--------+------------------+--------+-----------------------+
| user_id(PK)    |        | keranjang_id(PK) |        | item_keranjang_id(PK) |
| tipe_user      |        | user_id(FK)      |        | keranjang_id(FK)      |
| email          |        | total_qty        |        | variant_id(FK)        |
| password       |        | total_price      |        | quantity              |
| no_hp          |        | last_update      |        | subtotal              |
| status         |        +------------------+        +-----------------------+  
| login terakhir |
+----------------+ 
```

---

## Kesimpulan 

Tabel **Keranjang Sementara** dijadikan tabel tersendiri karena:

- Memenuhi prinsip normalisasi hingga 3NF
- Mendukung fleksibilitas perubahan isi keranjang
- Mendukung skalabilitas sistem
- Menyimpan ringkasan transaksi sebelum checkout, tidak bersifat final

---



