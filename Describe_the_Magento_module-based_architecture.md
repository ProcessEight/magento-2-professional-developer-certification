# Describe the Magento module-based architecture

## Describe module architecture

A module is a self-contained, low-coupling unit of related functionality.

Modules must comply with PSR-4.

A module must have, as a bare minimum:

* A `registration.php` file, which notifies Magento of the modules' existence
* A component-specific XML file, which declares component-specific configuration data
    * For a module, `etc/module.xml` declares the module name, setup version and dependencies on other modules 
* If you intend to distribute the module, a `composer.json` file which declares any dependencies.

Source: https://devdocs.magento.com/guides/v2.2/extension-dev-guide/intro/developers_roadmap.html

## What are the significant steps to add a new module?

To add a new module, the following steps need to be taken as a minimum:

* Create the `app/code/VendorName/ModuleName` folder structure.
* Create the `registration.php` file.
* Create the `app/code/VendorName/ModuleName/etc` folder.
* Create the `module.xml` file inside the `etc` directory.
* Run the `php -f bin/magento setup:upgrade` command.

Source: https://devdocs.magento.com/videos/fundamentals/create-a-new-module/

## What are the different Composer package types?

There are five `composer` package types:

* `magento2-module`: Defines a module. The `composer.json` file for a module extension declares external dependencies that it needs to function.
* `magento2-theme`: Defines a theme. The `composer.json` file for a theme component contains parent theme dependencies the extension needs to inherit.
* `magento2-language`: Defines a language pack. For language packages, you must use the correct ISO code for the language code in the `composer.json` file.
* `magento2-library`: Defines a library. The Magento application uses this `composer.json` file for its framework packages.
* `magento2-component` Defines a general extension that does not fit any of the other types.

The extension type tells the system where to install the directories and files of each extension in the Magento directory structure.

Source: https://devdocs.magento.com/guides/v2.2/extension-dev-guide/build/composer-integration.html#magento-specific-package-types
 
## When would you place a module in the app/code folder versus another location?

* If you had no intention of distributing it
* You do not want to manage it by `composer` (perhaps a project-specific module)
* If you installed Magento without using `composer` 

If you build a module for a specific project, it is best to choose the app/code folder and commit to the project’s repository.

If you build an extension to be reused, it is better to use composer to create it, and put your module in the vendor/<YOUR_VENDOR>/module-something folder.

Source: https://devdocs.magento.com/videos/fundamentals/create-a-new-module/

