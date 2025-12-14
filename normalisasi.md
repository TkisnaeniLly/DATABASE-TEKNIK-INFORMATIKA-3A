# 📄 Tabel Subscription

## 1. Deskripsi Umum
Tabel **Subscription** merupakan tabel master yang digunakan untuk menyimpan data paket langganan yang tersedia dalam sistem.  
Tabel ini tidak menyimpan data pengguna maupun periode langganan user, melainkan hanya mendefinisikan jenis paket langganan secara umum.

---

## 2. Fungsi Tabel Subscription
- Menyediakan daftar paket langganan yang dapat dipilih oleh user
- Menyimpan informasi harga dan durasi paket
- Menjadi referensi utama bagi tabel `User_Subscription`
- Memisahkan data master paket dari data transaksi user (normalisasi)

---

## 3. Atribut Tabel Subscription

| Nama Atribut | Tipe Data | Keterangan |
|--------------|----------|------------|
| `subsc_id` | INT | Primary Key, identitas unik setiap paket langganan |
| `nama_langganan` | VARCHAR(100) | Nama paket langganan (contoh: Basic, Premium) |
| `deskripsi` | TEXT | Penjelasan singkat mengenai fitur atau benefit paket |
| `price` | DECIMAL(12,2) | Harga paket langganan |
| `duration_days` | INT | Durasi langganan dalam satuan hari |
| `status` | ENUM('ACTIVE','INACTIVE') | Status ketersediaan paket langganan |

---

## 4. Penjelasan Fungsi Setiap Atribut
- **subsc_id**  
  Digunakan sebagai identitas unik paket langganan dan sebagai referensi Foreign Key pada tabel lain.
- **nama_langganan**  
  Menampilkan nama paket agar mudah dikenali oleh user.
- **deskripsi**  
  Memberikan informasi tambahan mengenai benefit paket.
- **price**  
  Menentukan biaya yang harus dibayar user untuk menggunakan paket tersebut.
- **duration_days**  
  Menentukan masa berlaku paket langganan.
- **status**  
  Menentukan apakah paket masih tersedia atau tidak.

---

## 5. Relasi Tabel Subscription

### Relasi dengan Tabel User_Subscription
- **Jenis Relasi:** One-to-Many (1 : N)
- **Penjelasan:**  
  Satu Subscription dapat digunakan oleh banyak User_Subscription, tetapi satu User_Subscription hanya merujuk pada satu Subscription.


### Alasan Tidak Berelasi Langsung dengan User
- Subscription adalah data master
- Data user dan periode langganan dicatat pada tabel `User_Subscription`
- Menghindari redundansi data dan anomali

---

## 6. Analisis Desain Tabel
- Tabel Subscription hanya menyimpan data yang bersifat **umum dan tetap**
- Tidak menyimpan data:
  - user_id
  - start_date
  - end_date
- Desain ini memisahkan:
  - **data master** (Subscription)
  - **data transaksi/riwayat** (User_Subscription)

Keuntungan desain:
- Mudah melakukan perubahan harga atau durasi
- Tidak mempengaruhi data langganan user yang sudah ada
- Struktur database lebih fleksibel dan terstruktur

---

## 7. Normalisasi Tabel Subscription

### First Normal Form (1NF)
- Semua atribut bernilai atomik
- Tidak ada atribut multivalue
✅ Terpenuhi

### Second Normal Form (2NF)
- Primary key tunggal (`subsc_id`)
- Semua atribut bergantung penuh pada primary key
✅ Terpenuhi

### Third Normal Form (3NF)
- Tidak ada ketergantungan transitif
- Semua atribut non-key hanya bergantung pada `subsc_id`
✅ Terpenuhi

---

## 8. Kesimpulan
Tabel Subscription telah dirancang sebagai tabel master yang terpisah dari data user dan transaksi.  
Desain ini memenuhi prinsip normalisasi hingga **Third Normal Form (3NF)** serta mendukung integrasi yang baik dengan tabel `User_Subscription`.

---

## 9. Ringkasan Singkat
- Subscription = tabel master
- Tidak menyimpan data user
- Relasi hanya ke User_Subscription
- Desain terstruktur dan ter-normalisasi

