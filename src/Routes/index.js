const express = require("express");
const router = express.Router();
const app = require("../Controllers/index");

// Auth
router.post("/auth/register", app.register);
router.get("/auth/verify-email", app.verifyEmail);
// Users
router.get("/users/", app.home);
router.get("/users/home", app.home);
router.get("/users/beranda", app.home);

module.exports = router;
