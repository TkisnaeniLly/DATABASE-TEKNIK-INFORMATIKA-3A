## Analisis dan Normalisasi Tabel Review/Rating

### Atribut Awal

Berdasarkan data yang tersedia, atribut untuk Tabel Review/Rating adalah:

| Atribut | Keterangan |
| :--- | :--- |
| `Review Id` | Primary Key ulasan/rating |
| `User Id` | Foreign Key ke tabel User |
| `Product Id` | Foreign Key ke tabel Produk |
| `Rating` | Nilai rating (misalnya 1-5) |
| `Review Text` | Teks ulasan |
| `Created At` | Waktu ulasan dibuat |

---

### Proses Normalisasi

#### First Normal Form (1NF)

* Tidak ada atribut *multivalue* atau *repeating*.
* Setiap *field* bernilai atomik.

**LULUS 1NF** (Asumsi semua nilai pada kolom tunggal dan atomik).

#### Second Normal Form (2NF)

* Tabel memiliki Primary Key tunggal: `Review Id`.
* Semua atribut non-key (`Rating`, `Review Text`, `Created At`) bergantung penuh pada Primary Key (`Review Id`).
* Tidak ada ketergantungan parsial, karena Primary Key-nya adalah kunci tunggal.

**LULUS 2NF**

#### Third Normal Form (3NF)

* Tidak terdapat dependensi transitif antar atribut non-key.
* Atribut non-key (`Rating`, `Review Text`, `Created At`) bergantung langsung pada Primary Key (`Review Id`) dan tidak bergantung pada atribut non-key lainnya dalam tabel yang sama.

**LULUS 3NF**

---

### Keputusan Normalisasi (Dijadikan Tabel Database)

Tabel **Review/Rating** harus **dijadikan tabel tersendiri dalam database**.

#### Alasan:

1.  **Memenuhi Normalisasi:** Tabel sudah memenuhi prinsip normalisasi hingga 3NF.
2.  **Integritas Data:** Menyimpan data ulasan/rating secara terstruktur memastikan integritas, akurasi, dan konsistensi data ulasan untuk setiap produk dan pengguna.
3.  **Kebutuhan Bisnis:** Ulasan dan rating adalah informasi penting yang digunakan untuk:
    * Menghitung rating rata-rata produk.
    * Menampilkan ulasan kepada calon pembeli (sangat sering diakses).
    * Analisis kualitas produk/layanan.
    * Proses ini membutuhkan penyimpanan data permanen.
4.  **Skalabilitas dan Akses:** Menyimpan data ini dalam database mempermudah proses pencarian (siapa yang memberi ulasan), pembaruan (misalnya status ulasan), dan pelaporan (laporan ulasan mingguan).

---

### Relasi Antar Tabel

* **User (1) → (N) Review/Rating**: Satu pengguna dapat memberikan banyak ulasan.
* **Produk (1) → (N) Review/Rating**: Satu produk dapat memiliki banyak ulasan.
* Relasi yang lebih akurat mungkin **User (N) ← (M) Produk** melalui tabel `Review/Rating` (Many-to-Many), di mana `Review Id` adalah Primary Key yang unik untuk setiap entri ulasan.

---

### Kesimpulan

Tabel **Review/Rating** harus dijadikan tabel tersendiri dalam database karena:

* Memenuhi prinsip normalisasi hingga 3NF.
* Data ini bersifat **permanen** dan **vital** untuk informasi produk.
* Diperlukan untuk perhitungan statistik dan tampilan data di antarmuka pengguna, yang membutuhkan akses cepat dan terstruktur.


---

Apakah Anda ingin saya menganalisis dan membuat normalisasi untuk tabel lain yang dimiliki oleh mahasiswa pada daftar tersebut?