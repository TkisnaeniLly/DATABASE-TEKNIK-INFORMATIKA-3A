const jwt = require("jsonwebtoken");

const authenticated = (req, res, next) => {
  try {
    const token = req.cookies.authToken;

    // Jika tidak ada token → redirect login
    if (!token) {
      console.warn("⛔ Akses ditolak: tidak ada token");
      return res.redirect("/auth");
    }

    // Verifikasi token
    let decoded;
    try {
      decoded = jwt.verify(token, process.env.JWT_SECRET);
    } catch (err) {
      console.warn("⛔ Token invalid / expired:", err.message);
      return res.redirect("/auth");
    }

    // Simpan user ke locals (untuk EJS)
    res.locals.user = {
      id: decoded.id,
      username: decoded.username,
      role: decoded.role,
    };

    console.log("✅ Authenticated:", res.locals.user);

    next();
  } catch (error) {
    console.error("❌ Middleware Auth Error:", error);

    const status = 500;
    return res.status(status).render("error/page", {
      title: `${status} Server Error`,
      description: "Internal Server Error",
      message: error.message || "Server Error",
      keywords: status.toString(),
      errorCode: status.toString(),
    });
  }
};

module.exports = authenticated;
