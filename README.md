# Backend

Backend bagian dari proyek **Aplikasi E-Commerce** Backend berfungsi sebagai penyedia REST API,
pengelola logika bisnis, middleware, serta penghubung antara frontend dan basis data.

---

## 🚀 Menjalankan Backend

### 1. Install dependency

```bash
npm install
```

### 2. Konfigurasi environment

Ganti nama file `.env.sample` menjadi `.env`, sesuaikan isi dari masing-masing variabel.

```env
PORT=3000
NODE_ENV=development
...
...
...
```

### 3. Jalankan server

```bash
npm run dev
```

---

## 🖥 Contoh Log Terminal

```text
[nodemon] starting `node App.js`
Registered aliases from index.js
🚀 Server running on port 3000
LOG REQUEST {
  path: '/',
  ipClient: '127.0.0.1',
  hostname: 'localhost',
  protocol: 'http',
  method: 'GET',
  dateTime: '15 Desember 2025 pukul 00.30 WIB'
}
```

---

## 📡 Dokumentasi Routes / Endpoint

Endpoint berikut disediakan oleh backend sebagai **REST API** untuk kebutuhan aplikasi.

### 📍 User / Home

| Method | Endpoint     | Deskripsi                                      |
| ------ | ------------ | ---------------------------------------------- |
| GET    | `/api/users` | Mengambil data user / endpoint awal (home API) |

---

### 🔐 Autentikasi

| Method | Endpoint                 | Deskripsi                |
| ------ | ------------------------ | ------------------------ |
| POST   | `/api/auth/register`     | Registrasi user baru     |
| POST   | `/api/auth/login`        | Autentikasi user (login) |
| POST   | `/api/auth/logout`       | Logout user              |
| GET    | `/api/auth/verify-email` | Verifikasi email user    |

---

### 📌 Catatan Teknis

- Semua endpoint:
  - Menggunakan format **JSON**
  - Mengikuti prinsip **RESTful API**
- Request & response:
  - Data dikirim melalui body (`POST`)
  - Data sensitif **tidak dikirim melalui URL**
- Endpoint dapat berkembang sesuai kebutuhan aplikasi

## 🧠 Dokumentasi App.js

App.js berfungsi sebagai entry point aplikasi backend dengan alur:

1. Inisialisasi Express
2. Registrasi middleware global
3. Registrasi routes
4. Menjalankan server berdasarkan PORT dari environment

---

## 📌 Baca terlebih dahulu file

[CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md), [CONTRIBUTING.md](CONTRIBUTING.md), dan [GIT_WORKFLOW.md](GIT_WORKFLOW.md)  
agar tidak terjadi kesalahan saat mengembangkan aplikasi ini.
