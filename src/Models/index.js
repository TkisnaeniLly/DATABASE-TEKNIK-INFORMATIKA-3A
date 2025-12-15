const sequelize = require("../Config/sequelizeConnect");

const User = require("./scripts/User");
const UserProfile = require("./scripts/UserProfile");
const EmailVerification = require("./scripts/EmailVerification");

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

module.exports = {
  sequelize,
  User,
  UserProfile,
  EmailVerification,
};
