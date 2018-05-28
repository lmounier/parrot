const allowedLabels = ["Back", "management", "Front", "maquette", "bug"];

exports.mapLabelsToLabelId = (labels = []) => {
  const label = labels.reduce((acc, item) => {
    if (allowedLabels.includes(item.name)) {
      return item.name;
    }
    return acc;
  }, null);

  switch (label) {
    case "Back":
      return 1;
    case "management":
      return 3;
    case "Front":
      return 6;
    case "maquette":
      return 7;
    case "bug":
      return 8;
    default:
      return null;
  }
};

exports.getSprintNumber = sprintName => {
  if (!sprintName) {
    return 6;
  }

  if (sprintName.title.includes("4")) {
    return 4;
  }
  if (sprintName.title.includes("5")) {
    return 5;
  }

  return 6;
};
