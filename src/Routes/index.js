const express = require("express");
const router = express.Router();
const app = require("../Controllers/index");

router.get("/", app.home);

module.exports = router;
