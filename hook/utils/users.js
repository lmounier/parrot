exports.mapGithubAccountToUserId = username => {
  switch (username) {
    case "lmounier":
      return 1;
    case "the-smaug":
      return 2;
    case "Oceanwave6":
      return 3;
    case "Benbb96":
      return 4;
    case "martinjeremyl":
      return 5;
    case "HighnKein":
      return 6;
    case "manierka":
      return 7;
    case "m5r":
      return 8;
    case "qreboli":
      return 9;
    default:
      return null;
  }
};
