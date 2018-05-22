'use strict';
module.exports = (sequelize, DataTypes) => {
  var Task = sequelize.define('Task', {
    libelle: DataTypes.STRING,
    pc: DataTypes.INTEGER,
    id_us: DataTypes.INTEGER,
    id_sprint: DataTypes.INTEGER,
    url: DataTypes.STRING,
    id_type_tache: DataTypes.INTEGER,
    id_utilisateur: DataTypes.INTEGER,
    status: DataTypes.STRING,
    numero: DataTypes.INTEGER
  }, {});
  Task.associate = function(models) {
    // associations can be defined here
  };
  return Task;
};