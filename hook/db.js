const Sequelize = require("sequelize");
const sequelize = new Sequelize(
  "postgres://postgres:postgres@54.37.158.186:5432/parrot_hook"
);

module.exports = sequelize;
