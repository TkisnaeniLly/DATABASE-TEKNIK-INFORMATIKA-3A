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

const loginPage = require("./Auth/Login");
const login = async (req, res) => {
  return loginPage(req, res);
};

const verifyLoginOtpPage = require("./Auth/VerifyLoginOtp");
const verifyLogin = async (req, res) => {
  return verifyLoginOtpPage(req, res);
};

const logoutPage = require("./Auth/Logout");
const logout = async (req, res) => {
  return logoutPage(req, res);
};
const logoutAllPage = require("./Auth/LogoutAll");
const logoutAll = async (req, res) => {
  return logoutAllPage(req, res);
};
const getUserDevicesPage = require("./Auth/GetUserDevices");
const getUserDevices = async (req, res) => {
  return getUserDevicesPage(req, res);
};
const revokeDevicePage = require("./Auth/RevokeDevice");
const revokeDevice = async (req, res) => {
  return revokeDevicePage(req, res);
};

const catalogPage = require("./Catalog/index");
const catalog = async (req, res) => {
  return catalogPage(req, res);
};

module.exports = {
  home,
  register,
  verifyEmail,
  login,
  verifyLogin,
  logout,
  logoutAll,
  getUserDevices,
  revokeDevice,
  catalog,
};
