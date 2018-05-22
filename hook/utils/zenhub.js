const axios = require("axios");

const BASE_URL = "https://api.zenhub.io/p1/repositories/106805253";
const TOKEN =
  "2b8b2dd3e64b4f7b66d96fb5e24c4bd4f12c92f2ba69dec49bbb22e5e3f9302847843622e36dd072";

const axiosInstance = axios.create({
  baseURL: BASE_URL,
  params: {
    access_token: TOKEN
  }
});

module.exports = axiosInstance;
