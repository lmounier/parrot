const models = require("./models");
const db = require("./db");
const { mapGithubAccountToUserId } = require("./utils/users");
const zenhubFetch = require("./utils/zenhub");
const { getEstimation, getStatus } = require("./utils/selector");

const githubHook = ({ action, issue, comment }) => {
  let haveMatch = true;

  switch (action) {
    case "opened": {
      const { number, title, assignee, html_url } = issue;
      const userId = mapGithubAccountToUserId(assignee.login);

      models.Task.create({
        libelle: title,
        pc: null,
        id_us: null,
        id_sprint: null,
        url: html_url,
        id_type_tache: null,
        id_utilisateur: userId,
        status: null,
        numero: number
      });
      break;
    }

    case "assigned": {
      const { number, assignee } = issue;
      const userId = mapGithubAccountToUserId(assignee.login);

      models.Task.update(
        {
          id_utilisateur: userId
        },
        {
          where: {
            numero: number
          }
        }
      );
      break;
    }

    case "created": {
      const { number, title, assignee, html_url } = issue;
      const userId = mapGithubAccountToUserId(assignee.login);

      if (comment.body.includes("parrot")) {
        models.Task.findAll({
          where: {
            numero: number
          }
        }).then(data => {
          if (data.length === 0) {
            models.Task.create({
              libelle: title,
              pc: null,
              id_us: null,
              id_sprint: null,
              url: html_url,
              id_type_tache: null,
              id_utilisateur: userId,
              status: null,
              numero: number
            });

            return;
          }

          zenhubFetch(`/issues/${number}`).then(({ data }) => {
            models.Task.update(
              {
                status: getStatus(data),
                pc: getEstimation(data)
              },
              {
                where: {
                  number: number
                }
              }
            );
          });
        });
      }

      haveMatch = false;
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
          status: getStatus(data),
          pc: getEstimation(data)
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
