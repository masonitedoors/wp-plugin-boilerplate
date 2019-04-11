# WP Plugin Boilerplate

A WordPress plugin boilerplate for [Masonite](https://www.masonite.com) with recommended settings for [VS Code](https://code.visualstudio.com/). This plugin enforces Masonite coding standards for scss, js, & php via linting during the build process as well as through local git hooks.

## Requirements

- PHP 7
- [Git](https://git-scm.com/) for version control
- [Composer](https://getcomposer.org/) for managing PHP dependencies
- [Node 8+](https://nodejs.org)
- [NPM](https://www.npmjs.com/) (Packaged with Node)

## VS Code

The plugin provideds a recommended set of settings for Visual Studio Code. In order to see inline errors, it is recommended that you install the following extensions:

- [ESLint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint)
- [phpcs](https://marketplace.visualstudio.com/items?itemName=ikappas.phpcs)

This plugin contains numerous configuration files that you will either never need to edit or rarely edit. Because of this, the following extension is also recommended.

- [Toggle Excluded Files](https://marketplace.visualstudio.com/items?itemName=eamodio.toggle-excluded-files)

## Internationalization

For the text in the plugin to be able to be translated easily the text should not be hardcoded in the plugin but be passed as an argument through one of the localization functions in WordPress.

[How to Internationalize Your Plugin →](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/)

This plugin contains a ready to go `.pot` can be found within `languages/`. This file can be updated using the following command:

```sh
npm run i18n
```

## License

WP Plugin Boilerplate is licensed under [GNU General Public License v2 (or later)](./LICENSE).
