Analisis & Perancangan Tabel User (Penggabungan Customer dan User)
1. Alasan Penggabungan Tabel

Pada rancangan awal, terdapat dua tabel terpisah yaitu User dan Customer.
Namun, dalam konteks sistem e-commerce seperti Zalora, setiap customer pasti merupakan user, dan tidak ada kebutuhan kuat untuk memisahkan keduanya.

Untuk meningkatkan efisiensi data, mengurangi redundansi, serta mempermudah relasi antar tabel, maka tabel User dan Customer digabung menjadi satu tabel bernama users.

🗂️ Tabel: users
Atribut Tabel
Nama Atribut	Tipe	Keterangan
user_id	PK	ID unik user
role	Enum	Jenis user (customer, admin)
email	Varchar	Email untuk login
password	Varchar	Password user
phone_number	Varchar	Nomor HP user
full_name	Varchar	Nama lengkap user
gender	Enum	Jenis kelamin
birth_date	Date	Tanggal lahir
status	Enum	Status akun (aktif / nonaktif)
registered_at	DateTime	Tanggal pendaftaran
last_login	DateTime	Login terakhir
🔗 Relasi dengan Tabel Lain

Tabel users memiliki relasi dengan beberapa tabel lain, yaitu:

Tabel Tujuan	Relasi	Keterangan
alamat_pengiriman	1 : N	Satu user bisa memiliki banyak alamat
keranjang	1 : 1	Satu user memiliki satu keranjang aktif
pesanan	1 : N	Satu user bisa membuat banyak pesanan
wishlist	1 : N	User dapat menyimpan banyak produk favorit
user_subscription	1 : N	User dapat memiliki riwayat langganan
review	1 : N	User dapat memberikan review produk
klaim_promo	1 : N	User dapat mengklaim promo
log_aktivitas	1 : N	Aktivitas user dicatat oleh sistem
⚙️ Fungsi Tabel users

Tabel users berfungsi sebagai:

Penyimpanan data identitas pengguna sistem

Dasar autentikasi dan otorisasi

Penghubung utama ke seluruh aktivitas user (pesanan, pembayaran, review, return, subscription)

📊 Analisis Normalisasi
First Normal Form (1NF)

Semua atribut bernilai atomik

Tidak ada atribut multivalue

Setiap record dapat diidentifikasi dengan primary key (user_id)

✅ Memenuhi 1NF

Second Normal Form (2NF)

Primary key hanya satu atribut (user_id)

Semua atribut non-key bergantung sepenuhnya pada primary key

✅ Memenuhi 2NF

Third Normal Form (3NF)

Tidak terdapat ketergantungan transitif

Data pribadi, login, dan status user berada dalam satu entitas yang logis

Data alamat, transaksi, dan subscription dipisahkan ke tabel lain

✅ Memenuhi 3NF

🧠 Kesimpulan

Penggabungan tabel User dan Customer menjadi tabel users membuat desain database:

Lebih sederhana

Lebih efisien

Mudah dikembangkan

Sesuai dengan kebutuhan sistem e-commerce modern

Struktur ini mendukung fitur utama seperti login, transaksi, return, subscription, dan aktivitas user secara terintegrasi.
