const models = require("./models");
const db = require("./db");
const { mapGithubAccountToUserId } = require("./utils/users");
const zenhubFetch = require("./utils/zenhub");

const githubHook = ({ action, issue }) => {
  let haveMatch = true;

  switch (action) {
    case "opened": {
      const { number, title, assignee, html_url } = issue;
      const userId = mapGithubAccountToUserId(assignee.login);

      models.Task.create({
        user_id: userId,
        user_story_id: null,
        sprint_id: null,
        name: title,
        complexity: null,
        url: html_url,
        number: number
      });
      break;
    }

    case "assigned": {
      const { number, assignee } = issue;
      const userId = mapGithubAccountToUserId(assignee.login);

      models.Task.update(
        {
          user_id: userId
        },
        {
          where: {
            number: number
          }
        }
      );
      break;
    }

    default:
      haveMatch = false;
      break;
  }

  if (haveMatch) {
    const { number } = issue;
    zenhubFetch(`/issues/${number}`).then(({ data }) => {
      models.Task.update(
        {
          user_id: userId
        },
        {
          where: {
            number: number
          }
        }
      );
    });
  }
};

module.exports = githubHook;
