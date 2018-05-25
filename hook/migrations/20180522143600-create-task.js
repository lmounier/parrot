"use strict";
module.exports = {
  up: (queryInterface, Sequelize) => {
    return queryInterface.createTable("Tasks", {
      id: {
        allowNull: false,
        autoIncrement: true,
        primaryKey: true,
        type: Sequelize.INTEGER
      },
      libelle: {
        type: Sequelize.STRING
      },
      pc: {
        type: Sequelize.INTEGER
      },
      id_us: {
        type: Sequelize.INTEGER
      },
      id_sprint: {
        type: Sequelize.INTEGER
      },
      url: {
        type: Sequelize.STRING
      },
      id_type_tache: {
        type: Sequelize.INTEGER
      },
      id_utilisateur: {
        type: Sequelize.STRING
      },
      status: {
        type: Sequelize.STRING
      },
      numero: {
        type: Sequelize.INTEGER
      },
      createdAt: {
        allowNull: false,
        type: Sequelize.DATE
      },
      updatedAt: {
        allowNull: false,
        type: Sequelize.DATE
      }
    });
  },
  down: (queryInterface, Sequelize) => {
    return queryInterface.dropTable("Tasks");
  }
};
