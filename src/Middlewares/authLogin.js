const jwt = require("jsonwebtoken");

const authLogin = (req, res, next) => {
  // Ambil token dari cookie
  const token = req.cookies.authToken;
  const method = req.method.toUpperCase();

  // Jika user BELUM login → hanya GET & POST diperbolehkan (login-page & login-submit)
  if (!token) {
    if (method === "GET" || method === "POST") {
      return next(); // izinkan akses login
    }

    // Selain itu (misal DELETE) tetap izinkan, karena logout tidak butuh token
    return next();
  }

  // Jika token ADA → user sedang login
  let decoded;
  try {
    decoded = jwt.verify(token, process.env.JWT_SECRET);
  } catch (err) {
    // Token invalid/expired → perlakukan sebagai belum login
    return next();
  }

  // =============================
  // User SUDAH LOGIN
  // =============================

  // Simpan user ke res.locals agar bisa dipakai di view
  res.locals.user = decoded;

  // Jika GET atau POST → blokir (karena sudah login)
  if (method === "GET" || method === "POST") {
    return res.redirect("/dashboard");
  }

  // Jika DELETE → izinkan (logout)
  if (method === "DELETE") {
    return next();
  }

  // Default: izinkan
  next();
};

module.exports = authLogin;
