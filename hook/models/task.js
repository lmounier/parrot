'use strict';
module.exports = (sequelize, DataTypes) => {
  var Task = sequelize.define('Task', {
    user_id: DataTypes.INTEGER,
    user_story_id: DataTypes.INTEGER,
    name: DataTypes.STRING,
    complexity: DataTypes.INTEGER,
    url: DataTypes.STRING,
    number: DataTypes.INTEGER,
    sprint_id: DataTypes.INTEGER
  }, {});
  Task.associate = function(models) {
    // associations can be defined here
  };
  return Task;
};