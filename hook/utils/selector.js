exports.getEstimation = issueData => {
  if (issueData.estimate && issueData.estimate.value) {
    return issueData.estimate.value;
  }

  return null;
};

exports.getStatus = issueData => {
  if (issueData.pipeline && issueData.pipeline.name) {
    return issueData.pipeline.name;
  }

  return null;
};
