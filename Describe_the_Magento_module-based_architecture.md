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
* Run the `php -f bin/magento module:enable VendorName_ModuleName` command.
* Run the `php -f bin/magento setup:upgrade` command.

Source: 

## What are the different Composer package types?

There are three composer package types:

* `magento2-module`: Defines a module
* `magento2-theme`: Defines a theme
* `magento2-language`: Defines a translation/language pack
* `magento2-library`: A library used in the Magento Framework
 
Source: https://devdocs.magento.com/guides/v2.2/extension-dev-guide/build/composer-integration.html#composerjson-overview

## When would you place a module in the app/code folder versus another location?