const express = require("express");
const bodyParser = require("body-parser");

const github = require("./github");
const zenhub = require("./zenhub");

const PORT = 8080;

const app = express();

// parse application/json
app.use(bodyParser.json());

app.post("/github", (req, res) => {
  github(req);
  res.send(200);
});

app.post("/zenhub", (req, res) => {
  zenhub(req);
  res.send(200);
});

app.listen(PORT, () => console.log(`http://localhost:${PORT}`));
