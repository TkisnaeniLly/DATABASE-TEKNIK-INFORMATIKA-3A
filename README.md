# Backend

Backend bagian dari proyek **Aplikasi E-Commerce** Backend berfungsi sebagai penyedia REST API,
pengelola logika bisnis, middleware, serta penghubung antara frontend dan basis data.

---

## 📂 Struktur Folder

```
Backend/
├── App.js
├── .env
├── .gitignore
├── package.json
├── package-lock.json
├── request.rest
├── src/
│   ├── Assets/
│   │   ├── Public/
│   │   └── Private/
│   ├── Controllers/
│   │   ├── Home/
│   │   │   └── index.js
│   │   ├── Payments/
│   │   └── index.js
│   ├── Routes/
│   │   └── index.js
│   ├── Middlewares/
│   │   ├── authenticated.js
│   │   ├── authLogin.js
│   │   ├── errorHandlers.js
│   │   └── Log.js
│   └── Libs/
│       ├── index.js
│       └── Utils/
│           └── response.js
└── node_modules/
```

---

## 🚀 Menjalankan Backend

### 1. Install dependency

```bash
npm install
```

### 2. Konfigurasi environment

Buat file `.env`:

```env
PORT=3000
NODE_ENV=development
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

| Method | Endpoint | Deskripsi                     |
| ------ | -------- | ----------------------------- |
| GET    | `/`      | Endpoint utama (health check) |

---

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
