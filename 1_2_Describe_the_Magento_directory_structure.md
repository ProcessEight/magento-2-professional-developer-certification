# Describe the Magento module-based architecture

## Describe the Magento directory structure. 

Magento follows the PSR-0 standard for module name and structure. Modules are stored in `<MODULE_BASEDIR>`, which can be one of:

* `<MAGENTO_BASEDIR>/vendor/magento/module-<module>` for core Magento modules installed by composer
* `<MAGENTO_BASEDIR>/vendor/<namespace>/<module>` for third party modules installed by composer
* `<MAGENTO_BASEDIR>/app/code/Namespace/Module`, for modules not managed by composer

Source: https://devdocs.magento.com/guides/v2.2/architecture/archi_perspectives/components/modules/mod_intro.html#where-do-modules-live

### Determine how to locate different types of files in Magento.
 
#### Where are the files containing JavaScript, HTML, and PHP located? 

##### JavaScript

Module-specific JavaScript files are located in the `<MODULE_BASEDIR>/view/<area>/web/` directory.

Theme-specific JavaScript files for specific modules are located in the `<THEME_BASEDIR>/<Namespace>_<Module>/web/` directory.

Theme-specific JavaScript files are located in the `<THEME_BASEDIR>/web/` directory.

Source: https://devdocs.magento.com/guides/v2.2/javascript-dev-guide/javascript/js-resources.html 

##### HTML

* Module-specific PHTML files are located in `<MODULE_BASEDIR>/view/<area>/templates/<optional_further_directories>`.
* Theme-specific PHTML files are located in `<theme_dir>/<Namespace>_<Module>/templates/<optional_further_directories>`
* Module-specific HTML templates for pages are located in `<MODULE_BASEDIR>/view/<area>/web/`.
* Module-specific HTML templates for transactional emails are located in `<MODULE_BASEDIR>/view/<area>/email/`.

Source: https://devdocs.magento.com/guides/v2.2/frontend-dev-guide/templates/template-override.html#template-convention 

##### PHP

PHP files are stored in the following locations:

* `<MAGENTO_BASEDIR>/vendor/magento/module-<module>` for core Magento modules installed by composer
* `<MAGENTO_BASEDIR>/vendor/<namespace>/<module>` for third party modules installed by composer
* `<MAGENTO_BASEDIR>/app/code/Namespace/Module`, for modules not managed by composer
* PHP libraries can also be located in `<NAGENTO_BASEDIR>/lib`

Source: https://devdocs.magento.com/guides/v2.2/architecture/archi_perspectives/components/modules/mod_intro.html#where-do-modules-live

* Module-specific PHTML files are located in `<MODULE_BASEDIR>/view/<area>/templates/<optional_further_directories>`.
* Theme-specific PHTML files are located in `<theme_dir>/<Namespace>_<Module>/templates/<optional_further_directories>`

Source: https://devdocs.magento.com/guides/v2.2/frontend-dev-guide/templates/template-override.html#template-convention 

#### How do you find the files responsible for certain functionality? How can you identify the files responsible for some functionality?

* From the namespace
* From the location

Magento core files are always located in the `vendor/magento` folder (if you installed it using Composer).

Frontend-related files (static assets, templates, layout XML) which are module-specific are located in the modules' `view` folder.

Generic and theme-specific frontend-related files are located in the `<MAGENTO_BASEDIR>/app/design` folder.

##### `Api` folder

Stores Service Contract interfaces. These interfaces define a stable API for your module and others to implement. 

##### `Api\Data` folder

Stores Data Service Contracts, or Data Transfer Objects (DTOs). DTOs define the structure of interfaces which represent data, e.g. a Product Interface. The concrete implementation of DTO should contain only getters and setters - they should not contain any logic.

##### `Blocks` folder

Stores Blocks and View Models. This folder is basically the same as it was in Magento 1.

The purpose of Blocks is virtually the same as in Magento 1.

View Models are a new addition in Magento 2. They encapsulate the business logic of a template, just like a Block, but they do not have any rendering logic. When using a View Model, the business logic is handled inside the View Model and the rendering of the template is handled by the Block. No business logic is added to the Block. 

##### `Console` folder

Magento 2 now has it's own CLI tool. New commands can be added and stored in here. 

##### `Controller` folder

Stores controllers, just like Magento 1. Controllers have changed a bit since then, so the internal architecture of this folder is a little different.

Controllers for `adminhtml` pages are stored in the `Adminhtml` sub-folder. This is a 'magic' path - Magento expects `adminhtml` controllers to be in this location.

The file `vendor/magento/framework/App/FrontController.php` is used for determining which `router` and thus which `controller` is used to fulfil a request.

The default router for most frontend requests is `vendor/magento/framework/App/Router/Base.php`

##### `Cron` folder

Stores classes which contain the logic for cron jobs.

##### `etc` folder

Just like Magento 1, config XML lives here. There is a lot more XML in Magento 2 and most of that (excluding layout XML) now lives in here too.

Config for different application areas (e.g. cron, frontend, adminhtml) can be added by creating a sub-folder in this directory with the area name and adding a new config XML file, e.g. Instructions defined in `etc/adminhtml/di.xml` will only affect the adminhtml area and will override identical instructions in the global scope of `etc/di.xml`. 

However, some files can only be global (e.g. `acl.xml`), some can be area specific (e.g. `routes.xml` or `sections.xml`) and some can be both (`di.xml`).

Source: https://devdocs.magento.com/guides/v2.2/extension-dev-guide/build/required-configuration-files.html#use-etc-for-your-configuration-files

##### `Helper` folder

Helpers are still used in Magento 2, though they are now discouraged. Since the folder structure in Magento 2 is less rigid, it is better to place code under a more meaningful namespace.

Source: https://devdocs.magento.com/guides/v2.2/ext-best-practices/extension-coding/common-programming-bp.html#avoid-creating-helper-classes

##### `i18n` folder

Module-specific internationalisation files (translation files) are located here.

##### `Model` folder

Business logic should be encapsulated in the classes in this folder.

The classes in here should be designed to 'model' an entity (eg. Product, Customer), including concrete implementations of `Data interfaces`.

##### `Model/ResourceModel` folder

Logic relating to persisting data, e.g. The CRUD functions of a module is located in here, including concrete implementations of `Service interfaces`.

##### `Observer` folder
Event listeners must implement `\Magento\Framework\Event\ObserverInterface`

##### `Plugin` folder

##### `Setup` folder

##### `Test` folder

##### `UI` folder

#### `view/<area>` folder

There are several possible subfolders in the `view` folder. They are all grouped by the `area`:

##### `layout` folder

##### `templates` folder

##### `adminhtml/ui_components` folder

##### `web` folder

##### `web/template` folder

##### `requirejs-config.js` file

### What are the naming conventions, and how are namespaces established?

The naming convention for modules follows the `VendorName_ModuleName` pattern.

Magento modules must follow the PSR-4 autoloader convention. The PSR-0 autoloader convention is also used.

Magento uses the `psr-4` and `psr-0` nodes in the root `composer.json` to define paths for the autoloader.

Source: PSR-4 requirement: https://devdocs.magento.com/guides/v2.2/extension-dev-guide/bk-extension-dev-guide.html

Source: PSR-0 naming conventions: https://devdocs.magento.com/guides/v2.2/architecture/archi_perspectives/components/modules/mod_intro.html#where-do-modules-live

Source: General module naming conventions: https://devdocs.magento.com/guides/v2.2/architecture/archi_perspectives/components/modules/mod_conventions.html#m2arch-module-conventions-location

## Suggestions for further research

* How has class name resolution changed since Magento 1?