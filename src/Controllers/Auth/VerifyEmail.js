const crypto = require("crypto");
const response = require("response");
const { User, EmailVerification } = require("../../Models");

const VerifyEmail = async (req, res) => {
  try {
    const { token } = req.query;

    // ======================
    // 1. Validasi token ada
    // ======================
    if (!token) {
      return response(res, {
        statusCode: 400,
        message: "Token verifikasi tidak ditemukan.",
        data: null,
      });
    }

    // ======================
    // 2. Hash token dari URL
    // ======================
    const tokenHash = crypto.createHash("sha256").update(token).digest("hex");

    // ======================
    // 3. Cari token di DB
    // ======================
    const verification = await EmailVerification.findOne({
      where: { token_hash: tokenHash },
    });

    if (!verification) {
      return response(res, {
        statusCode: 400,
        message: "Token verifikasi tidak valid.",
        data: null,
      });
    }

    // ======================
    // 4. Cek sudah diverifikasi
    // ======================
    if (verification.verified_at) {
      return response(res, {
        statusCode: 400,
        message: "Email sudah terverifikasi.",
        data: null,
      });
    }

    // ======================
    // 5. Cek expired
    // ======================
    if (new Date() > verification.expired_at) {
      return response(res, {
        statusCode: 400,
        message: "Token verifikasi sudah kedaluwarsa.",
        data: null,
      });
    }

    // ======================
    // 6. Ambil user
    // ======================
    const user = await User.findByPk(verification.user_id);

    if (!user) {
      return response(res, {
        statusCode: 404,
        message: "User tidak ditemukan.",
        data: null,
      });
    }

    // ======================
    // 7. Update status akun
    // ======================
    user.status_akun = "active";
    await user.save();

    // ======================
    // 8. Tandai token sudah dipakai
    // ======================
    verification.verified_at = new Date();
    await verification.save();

    // ======================
    // 9. Response sukses
    // ======================
    return response(res, {
      statusCode: 200,
      message: "Email berhasil diverifikasi. Akun Anda sudah aktif.",
      data: null,
    });
  } catch (error) {
    console.error("Error VerifyEmail Controller:", error);
    return response(res, {
      statusCode: 500,
      message: "Internal Server Error",
      data: null,
    });
  }
};

module.exports = VerifyEmail;
