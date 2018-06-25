const path = require('path');
const resourcesDir = path.resolve(__dirname, 'resources/assets');
const formatter = require('eslint-friendly-formatter');


module.exports = {
  root: true,
  parser: 'babel-eslint',
  parserOptions: {
    sourceType: 'module'
  },
  env: {
    browser: true,
    jquery: true,
  },

  extends: 'airbnb-base',
// required to lint *.vue files
  plugins: [
    'html'
  ],
// check if imports actually resolve
  "settings": {
    "import/resolver": {
      "webpack": {
        "config": {
          "resolve": {
            extensions: ['.js', '.vue', '.json', '.scss'],
            modules: [resourcesDir, "node_modules"],
          },
          module: {
            rules: [
              {
                test: /\.(js|vue)$/,
                loader: 'eslint-loader',
                enforce: 'pre',
                include: [resourcesDir],
                options: {
                  formatter: formatter
                }
              }
            ]
          },
        }
      }
    }
  },
// add your custom rules here
  'rules': {
    // don't require .vue extension when importing
    'import/extensions': ['error', 'always', {
      'js': 'never',
      'vue': 'never'
    }],
    // allow optionalDependencies
    'import/no-extraneous-dependencies': ['error', {
      'optionalDependencies': ['test/unit/index.js']
    }],
    'no-plusplus': 'off',
    'no-shadow': 'off',
    'no-restricted-globals': 'off',
    'func-names': 'off',
    'linebreak-style': ['off'],
    'no-implicit-coercion': 'error',
    'import/no-named-as-default': 'off',
    'import/newline-after-import': 'error',

    // allow debugger during development
    'no-debugger': process.env.NODE_ENV === 'production' ? 2 : 0
  }
}
