const { Sequelize } = require("sequelize");
require("dotenv").config();

// Tentukan environment (default: development)
const environment = process.env.NODE_ENV || "development";

// Konfigurasi database berdasarkan environment
const dbConfig =
  environment === "production"
    ? {
        database: process.env.DB_NAME,
        username: process.env.DB_USER,
        password: process.env.DB_PASS,
        host: process.env.DB_HOST,
      }
    : {
        database: process.env.DEV_DB_NAME,
        username: process.env.DEV_DB_USER,
        password: process.env.DEV_DB_PASS,
        host: process.env.DEV_DB_HOST,
      };

const sequelizeConnect = new Sequelize(
  dbConfig.database,
  dbConfig.username,
  dbConfig.password,
  {
    host: dbConfig.host,
    dialect: "mysql",
    logging: environment === "development" ? console.log : false,
  }
);

module.exports = sequelizeConnect;
