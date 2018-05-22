const express = require("express");
const bodyParser = require("body-parser");

const PORT = 8080;

const app = express();

// parse application/json
app.use(bodyParser.json());

app.post("/github", (req, res) => {
  console.dir(req.body);
  res.send("Hello");
});

app.post("/zenhub", (req, res) => {
  console.dir(req.body);
  res.send("Hello");
});

app.listen(PORT, () => console.log(`http://localhost:${PORT}`));
