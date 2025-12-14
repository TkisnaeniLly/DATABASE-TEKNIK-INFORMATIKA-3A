# DATABASE OVERVIEW – E-COMMERCE

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
6. Tabel Inventory (Ditambahkan oleh Daris Nabil Maftuh)
   Entitas utama : Inventory (Stok Produk)
   Atribut Utama : Inventory_Id (PK), Variant_Id (FK), Location_Id (FK), Stock_Qty, Stock_Minimum, Stock_Status, Last_Updated
   Relasi        : Inventory <> Varian Produk (1 : 1 / 1 : N) → Satu varian produk memiliki data stok.
                   Inventory <> Lokasi Operasional (N : 1) → Banyak data stok berada pada satu lokasi (gudang/toko).
                   Inventory <> Item Pesanan (tidak langsung) → Stok berkurang saat terjadi transaksi pembelian.
   Fungsi        : Mengelola ketersediaan stok setiap varian produk berdasarkan lokasi penyimpanan, memantau jumlah stok, serta mendukung proses pengendalian persediaan dan transaksi penjualan.
7...
8...
9...
10...
11...
12...
13...
14...
15...
16...
17...

   
18. Tabel Detail Pengiriman (Di tambahkan oleh Fajar Niko P)
    ENTITAS UTAMA : Detail Pengiriman
    ATRIBUT : ini di bawah yaa
            : Primary Key sebagai identitas unik data detail pengiriman
            : Order_Id Foreign Key (FK) merujuk ke tabel Pesanan (Tabel 13). Mengidentifikasi pesanan mana yang terkait dengan detail ini.
            :Courier_Id  Foreign Key (FK) merujuk ke tabel Jasa Pengiriman (Tabel 17). Mengidentifikasi layanan pengiriman yang digunakan.
            : Tracking_Number  Nomor resi resmi dari jasa pengiriman
            : Shipped_At  Tanggal dan waktu paket diserahkan ke kurir atau mulai dikirim
            : Delivered_At | Tanggal dan waktu paket berhasil diterima oleh customer
            :  Pengiriman_Status | Status terbaru paket (misalnya: Diambil Kurir, Dalam Perjalanan, Tiba di Hub, Diterima)
Relasi Tabel Detail Pengiriman
Tabel Detail Pengiriman adalah tabel yang sangat terikat dengan alur transaksi:
 Pesanan (Tabel 13) > 1 : 1 > Satu Pesanan memiliki Satu Detail Pengiriman (Order_Id FK). 
 Jasa Pengiriman (Tabel 17) > N : 1 > Banyak Detail Pengiriman menggunakan Satu Jenis Layanan Pengiriman (Courier_Id FK). 
 Patner Company (Tabel 28) > N : 1 > Secara tidak langsung, Jasa Pengiriman terkait dengan Partner Company (Logistik). 
 Kesimpulan
Tabel Detail Pengiriman dirancang untuk memastikan pengelolaan data logistik berjalan efisien, terpusat, dan mendukung fitur pelacakan real-time. Desain ini memenuhi kaidah normalisasi hingga Third Normal Form (3NF).

    

    
    
22. Tabel Klaim Promo (Ditambahkan oleh Dimas Faril Ardiansyah)
    ENTITAS UTAMA : (klaim promo)
    ATRIBUT : sebagai berikut ya ges
    -Klaim_id : sebagai primary key, identitas unik pada tabel klaim promo (Primary key), kunci utama.
    -user_id : menunjukan siapa yang klaim promo (Foreign key), relasi ke tabel = User.
    -Promo_id : promo yang di klaim (Foreign Key), relasi ke tabel = promo
    -Order_id : promo yang di gunakan pada pesanan tertentu (Foreign Key), relasinya ke tabel = order
    -Klaim_Date : yaitu waktu promo yang diklaim
    -Klaim_status : mengetahui promo yang di ambil berhasil/dibatalkan
    RELASI : ada 3 relasi yang bisa saya tunjukan:
    [klaim promo + User] : dengan relasinya itu One-to-Many(1:N) yaitu:
    -satu user bisa mengklaim banyak promo
    -satu klaim promo hanya milik satu user
    [Klaim promo + promo] : relasi One-to-Many(1:N) dijelaskan:
    -satu promo dapat digunakan oleh banyak user
    -satu klaim hanya untuk satu promo
    [Klaim promo + Pesanan] : relasinya One-to-One(1:0.1) yaitu:
    -satu pesanan boleh tidak pake promo
    -jika pake promo'n hanya satu promo 
        
26. Tabel Lokasi Operasional (Ditambahkan oleh Najwa Alief Nursfhifa)
Entitas utama : Lokasi Operasional
Atribut Utama : Location_Id (PK), Location_Name
Relasi : Lokasi Operasional <> Inventory (1 : N) → Satu lokasi operasional dapat menyimpan banyak data stok produk.
         Lokasi Operasional <> Unit Operasional (1 : N) → Satu lokasi operasional dapat digunakan oleh banyak unit atau aktivitas kerja.
Fungsi : Menyimpan dan mengelola data lokasi operasional sebagai referensi utama dalam sistem, memastikan konsistensi penggunaan lokasi pada berbagai modul, serta mendukung pengelolaan aktivitas operasional dan penyimpanan barang.

---

## Catatan

- Detail SQL dan implementasi teknis disesuaikan oleh Database Engineer (Satu Kelas)
- Dokumen ini digunakan sebagai acuan konseptual dan akademik
