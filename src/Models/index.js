const sequelize = require("../Config/sequelizeConnect");

// ==================
// Import Models
// ==================
const User = require("./scripts/User");
const UserProfile = require("./scripts/UserProfile");
const EmailVerification = require("./scripts/EmailVerification");
const UserLoginDevice = require("./scripts/UserLoginDevice");
const LoginOtp = require("./scripts/LoginOtp");

// ==================
// Relasi
// ==================

// User -> Profile (1 : 1)
User.hasOne(UserProfile, {
  foreignKey: "user_id",
  onDelete: "CASCADE",
});
UserProfile.belongsTo(User, {
  foreignKey: "user_id",
});

// User -> EmailVerification (1 : N)
User.hasMany(EmailVerification, {
  foreignKey: "user_id",
  onDelete: "CASCADE",
});
EmailVerification.belongsTo(User, {
  foreignKey: "user_id",
});

// User -> Login Device (1 : N)
User.hasMany(UserLoginDevice, {
  foreignKey: "user_id",
  onDelete: "CASCADE",
});
UserLoginDevice.belongsTo(User, {
  foreignKey: "user_id",
});

// User -> Login OTP (1 : N)
User.hasMany(LoginOtp, {
  foreignKey: "user_id",
  onDelete: "CASCADE",
});
LoginOtp.belongsTo(User, {
  foreignKey: "user_id",
});

// Device -> Login OTP (1 : N)
UserLoginDevice.hasMany(LoginOtp, {
  foreignKey: "device_id",
  sourceKey: "device_id",
  onDelete: "CASCADE",
});
LoginOtp.belongsTo(UserLoginDevice, {
  foreignKey: "device_id",
  targetKey: "device_id",
});

module.exports = {
  sequelize,
  User,
  UserProfile,
  EmailVerification,
  UserLoginDevice,
  LoginOtp,
};
