const path = require("path");
const { addAlias } = require("module-alias");

// Fungsi untuk mendaftarkan semua alias
function utilityAliases() {
  addAlias("response", path.join(__dirname, "Utils", "response.js"));
}

module.exports = utilityAliases;
