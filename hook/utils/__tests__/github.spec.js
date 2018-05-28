const assert = require("assert");

const { mapLabelsToLabelId } = require("../github");

const labels = [
  {
    name: "Développement"
  },
  {
    name: "Front"
  }
];

assert(mapLabelsToLabelId(labels));
