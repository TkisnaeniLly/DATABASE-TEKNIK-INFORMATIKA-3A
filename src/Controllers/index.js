const homePage = require("./Home");
const home = async (req, res) => {
  return homePage(req, res);
};

const registerPage = require("./Auth/Register");
const register = async (req, res) => {
  return registerPage(req, res);
};

const verifyEmailPage = require("./Auth/VerifyEmail");
const verifyEmail = async (req, res) => {
  return verifyEmailPage(req, res);
};
module.exports = {
  home,
  register,
  verifyEmail,
};
