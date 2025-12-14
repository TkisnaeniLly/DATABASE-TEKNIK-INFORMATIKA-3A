const homePage = require("./Home");
const home = async (req, res) => {
  return homePage(req, res);
};

module.exports = {
  home,
};
