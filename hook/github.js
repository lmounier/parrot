const task = require("./models/task");

const githubHook = ({ action, issue }) => {
  switch (action) {
    case "opened":
      const { number, title } = issue;
      console.log(title);
      break;

    default:
      break;
  }
};

module.exports = githubHook;
