const models = require("./models");
const db = require("./db");
const { mapGithubAccountToUserId, getUsersId } = require("./utils/users");
const zenhubFetch = require("./utils/zenhub");
const { getEstimation, getStatus } = require("./utils/selector");

const githubHook = ({ action, issue, comment }) => {
  let haveMatch = true;

  switch (action) {
    case "opened": {
      const { number, title, assignees, html_url } = issue;
      const usersId = getUsersId(assignees);

      models.Task.create({
        libelle: title,
        pc: null,
        id_us: null,
        id_sprint: null,
        url: html_url,
        id_type_tache: null,
        id_utilisateur: usersId,
        status: null,
        numero: number
      });
      break;
    }

    case "assigned": {
      const { number, assignees } = issue;
      const usersId = getUsersId(assignees);

      models.Task.update(
        {
          id_utilisateur: usersId
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
      const { number, title, assignees, html_url } = issue;

      const usersId = getUsersId(assignees);

      console.log(usersId);

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
              id_utilisateur: usersId,
              status: null,
              numero: number
            });

            return;
          }

          zenhubFetch(`/issues/${number}`).then(({ data }) => {
            models.Task.update(
              {
                libelle: title,
                status: getStatus(data),
                pc: getEstimation(data),
                id_utilisateur: usersId,
                url: html_url,
                numero: number
              },
              {
                where: {
                  numero: number
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
            numero: number
          }
        }
      );
    });
  }
};

module.exports = githubHook;
