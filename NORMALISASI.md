# NORMALISASI BASIS DATA -  MUHAMMAD ARMAN MAULANA

**Tahap 1** : Analisis dan Normalisasi 

---

## Atribut Awal  

| Atribut       | Keterangan                                   |
|---------------|----------------------------------------------|
| Varian_Id     | Primary Key varian                           |
| Product_id    | Foreign Key ke tabel Produk                  |
| Varian_Type   | Jenis varian(misalnya Warna,Ukuran,Material) |
| Ukuran_Varian | Nilai detail varian (contoh: Merah, Small)   |

---

## Proses Normalisasi  

### First Normal Form (1NF)  

- Tidak ada atribut multivalue atau repeating  
- Setiap field bernilai atomik  

**LULUS 1NF**  

---

### Second Normal Form (2NF)  

- Punya PK tunggal (`Varian_Id`)  
- Semua atribut non-key bergantung penuh ke PK  

**LULUS 2NF**  

---

### Third Normal Form (3NF)  

- Tidak terdapat dependensi transitif antar atribut non-key  
- `Varian_Type` dan `Ukuran_Varian` bergantung langsung pada `Varian_Id`, bukan pada atribut lain  

**LULUS 3NF**  

---

## Keputusan Normalisasi  

### Dijadikan Tabel Tersendiri  

Alasan:  

1. Tabel varian menyimpan detail variasi produk (warna, ukuran, material) secara terpisah dari tabel produk utama  
2. Mencegah redundansi data produk yang memiliki banyak varian  
3. Memudahkan pengelolaan stok dan harga berdasarkan varian  
4. Mendukung fleksibilitas sistem e-commerce (misalnya filter produk berdasarkan warna/ukuran)  

---

## Relasi Antar Tabel  

- **Produk (1) → (N) Varian**  
- **Varian (1) → (N) Item Keranjang**  

---

## ERD  
```
+----------------+        +------------------+        +-----------------------+
|    Produk      | 1    N |     Varian       | 1    N | Item Keranjang        |
+----------------+--------+------------------+--------+-----------------------+
| product_id(PK) |        | varian_id(PK)    |        | item_keranjang_id(PK) |
| nama_produk    |        | product_id(FK)   |        | keranjang_id(FK)      |
| kategori       |        | varian_type      |        | varian_id(FK)         |
| harga          |        | ukuran_varian    |        | quantity              |
| deskripsi      |        +------------------+        | subtotal              |
+----------------+                                     +-----------------------+
```

---

## Kesimpulan  

Tabel **Varian Produk** dijadikan tabel tersendiri karena:  
- Memenuhi prinsip normalisasi hingga 3NF  
- Menghindari duplikasi data produk dengan banyak varian  
- Mendukung fleksibilitas sistem (filter, stok, harga per varian)  
- Menjadi penghubung penting antara **Produk** dan **Item Keranjang**  