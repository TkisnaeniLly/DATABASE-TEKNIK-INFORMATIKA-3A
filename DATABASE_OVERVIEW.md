# DATABASE OVERVIEW – E-COMMERCE - Kim

**Gambaran umum database** pada website e-commerce fashion. Database dirancang menggunakan **basis data relasional** untuk mendukung fitur belanja, transaksi, return, pengiriman dan subscription.

---

## Tujuan Database

- Menyimpan data user dan customer
- Mengelola produk fashion beserta varian dan stok
- Mendukung proses keranjang, pesanan, pembayaran, dan pengiriman
- Mendukung fitur return, promo, wishlist, review, dan subscription

---

## Ringkasan Desain Database

- Database menggunakan konsep relasional
- Setiap tabel memiliki primary key
- Relasi antar tabel menggunakan foreign key
- Struktur database mendukung skalabilitas sistem

## Entitas Utama dan Fungsinya
1. **Tabel User** (Ditambahkan Oleh Tika Isnaeni)
Tabel users merupakan hasil penggabungan antara tabel User dan Customer untuk meningkatkan efisiensi penyimpanan data dan menghindari redundansi. Dalam sistem e-commerce (Zalora-like), customer pada dasarnya adalah user yang telah melakukan autentikasi dan memiliki aktivitas transaksi, sehingga pemisahan tabel dianggap tidak diperlukan.

Atribut:
Tabel users memiliki atribut sebagai berikut:
-user_id : sebagai primary key yang mengidentifikasi setiap pengguna secara unik.
-role : untuk menentukan peran pengguna dalam sistem, seperti customer atau admin.
-email : digunakan sebagai identitas login pengguna.
-password : untuk menyimpan kata sandi pengguna dalam bentuk terenkripsi.
-phone : untuk menyimpan nomor telepon pengguna.
-status : untuk menunjukkan status akun pengguna (aktif atau nonaktif).
-last_login : untuk mencatat waktu terakhir pengguna melakukan login.
-full_name : untuk menyimpan nama lengkap pengguna.
-gender : untuk menyimpan jenis kelamin pengguna.
-birth_date : untuk menyimpan tanggal lahir pengguna.
-registered_at : untuk mencatat waktu pendaftaran akun.

Relasi:
Tabel users memiliki relasi dengan beberapa tabel lain dalam sistem, antara lain:
-(Relasi tabel alamat_pengiriman) Satu pengguna dapat memiliki lebih dari satu alamat pengiriman.
-(Relasi tabel keranjang) Satu pengguna memiliki satu keranjang belanja aktif.
-(Relasi tabel pesanan) Satu pengguna dapat melakukan banyak pesanan.
-(Relasi tabel wishlist) Satu pengguna dapat memiliki banyak item wishlist.
-(Relasi tabel user_subcription) Satu pengguna dapat memiliki satu atau lebih data subscription.
-(Relasi tabel Return) Satu pengguna dapat mengajukan beberapa klaim promo atau diskon.
-(Relasi tabel review) Satu pengguna dapat memberikan banyak ulasan produk.
-(Relasi tabel log_aktivitas) Satu pengguna memiliki banyak catatan log aktivitas.
-(Relasi tabel riwayat_pencarian) Satu pengguna memiliki banyak riwayat pencarian produk.

Fungsi:
Tabel users berfungsi sebagai pusat data pengguna dalam sistem e-commerce. Tabel ini digunakan untuk mengelola autentikasi dan otorisasi pengguna, menyimpan data profil customer, serta menjadi referensi utama bagi seluruh aktivitas pengguna seperti transaksi, subscription, pengajuan return, dan penggunaan promo. Dengan adanya tabel ini, sistem dapat mengelola data pengguna secara terintegrasi dan konsisten.

Catatan:
Penggabungan tabel User dan Customer dilakukan untuk menjaga normalisasi data hingga Third Normal Form (3NF), mengurangi duplikasi data, serta meningkatkan performa query dalam sistem e-commerce.

2.
3.
4. ....
5.
6. Tabel Inventory (Ditambahk oleh Daris Nabil Maftuh)
   Entitas utama : Inventory (Stok Produk)
   Atribut Utama : Inventory_Id (PK), Variant_Id (FK), Location_Id (FK), Stock_Qty, Stock_Minimum, Stock_Status, Last_Updated
   Relasi        : Inventory <> Varian Produk (1 : 1 / 1 : N) → Satu varian produk memiliki data stok.
                   Inventory <> Lokasi Operasional (N : 1) → Banyak data stok berada pada satu lokasi (gudang/toko).
                   Inventory <> Item Pesanan (tidak langsung) → Stok berkurang saat terjadi transaksi pembelian.
   Fungsi        : Mengelola ketersediaan stok setiap varian produk berdasarkan lokasi penyimpanan, memantau jumlah stok, serta mendukung proses pengendalian persediaan dan transaksi penjualan.
7...
8...
....
26. Tabel Lokasi Operasional
    Entitas utama : Lokasi Operasional
    Atribut Utama : Location_Id (PK), Location_Name
   Relasi : Lokasi Operasional <> Inventory (1 : N) → Satu lokasi operasional dapat menyimpan banyak data stok produk.
            Lokasi Operasional <> Unit Operasional (1 : N) → Satu lokasi operasional dapat digunakan oleh banyak unit atau aktivitas kerja.
   Fungsi : Menyimpan dan mengelola data lokasi operasional sebagai referensi utama dalam sistem, memastikan konsistensi penggunaan lokasi pada berbagai modul, serta mendukung pengelolaan aktivitas operasional dan penyimpanan barang.
27.
28. Tabel Patner Company
    Entitas Utama: Patner Company (Perusahaan Mitra)
    Atribut Utama: Partner_Id (PK), Name, Logo_Url, Type (Logistics, Payment, Brand, Marketing)
    Relasi: Patner Company <> Produk (1 : N) → Satu Partner (sebagai Brand) dapat menyediakan banyak Produk.
            Patner Company <> Metode Pembayaran (1 : N) → Satu Partner (sebagai Payment Provider) dapat menyediakan satu atau lebih Metode Pembayaran.
            Patner Company <> Jasa Pengiriman (1 : N) → Satu Partner (sebagai Perusahaan Logistik) dapat menyediakan berbagai Service Jasa Pengiriman.
            Patner Company <> Promo (N : N) → Promo dapat bersifat eksklusif untuk Partner tertentu (misalnya, promo Bank X).
    Fungsi: Berfungsi sebagai tabel master untuk menyimpan dan mengelola data perusahaan eksternal yang bekerja sama dengan e-commerce, termasuk Brand yang dijual (misalnya Nike, H&M), Penyedia Pembayaran (Bank, E-Wallet), dan Perusahaan Logistik (Jasa Pengiriman).
            Memastikan data mitra terpusat dan konsisten di seluruh modul, seperti menampilkan logo brand di halaman produk atau logo bank di halaman checkout.
   
Kalau mau, kirim:

---

## Catatan

- Detail SQL dan implementasi teknis disesuaikan oleh Database Engineer (Satu Kelas)
- Dokumen ini digunakan sebagai acuan konseptual dan akademik
