/** @type {import('eslint').Linter.Config} */
const config = {
  parserOptions: {
    sourceType: 'module'
  },
  env: {
    browser: true,
    commonjs: true,
    node: true
  },
  extends: ['ackama'],
  ignorePatterns: ['/themes/watea/', '/themes/starter/', '/public/dist/']
};

module.exports = config;
