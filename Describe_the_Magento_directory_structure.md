# Describe the Magento module-based architecture

## Describe the Magento directory structure. 

### What are the naming conventions, and how are namespaces established?

The naming convention for modules follows the `VendorName_ModuleName` pattern.

Magento modules must follow the PSR-4 autoloader convention. The PSR-0 autoloader convention is also used.

Magento uses the `psr-4` and `psr-0` nodes in the root `composer.json` to define paths for the autoloader.

Source: PSR-4 requirement: https://devdocs.magento.com/guides/v2.2/extension-dev-guide/bk-extension-dev-guide.html

Source: PSR-0 naming conventions: https://devdocs.magento.com/guides/v2.2/architecture/archi_perspectives/components/modules/mod_intro.html#where-do-modules-live

Source: General module naming conventions: https://devdocs.magento.com/guides/v2.2/architecture/archi_perspectives/components/modules/mod_conventions.html#m2arch-module-conventions-location

### How can you identify the files responsible for some functionality?

* From the namespace
* From the location

Magento core files are always located in the `vendor/magento` folder (if you installed it using Composer).

Frontend-related files (static assets, templates, layout XML) which are module-specific are located in the modules' `view` folder.

Generic and theme-specific frontend-related files are located in the `{{MAGENTO_BASEDIR}}/app/design` folder.

#### `Api` folder

Stores Service Contract interfaces. These interfaces define a stable API for your module and others to implement. 

#### `Api\Data` folder

Stores Data Service Contracts, or Data Transfer Objects (DTOs). DTOs define the structure of interfaces which represent data, e.g. a Product Interface. The concrete implementation of DTO should contain only getters and setters - they should not contain any logic.

#### `Blocks` folderk

Stores Blocks and View Models. This folder is basically the same as it was in Magento 1.

The purpose of Blocks is virtually the same as in Magento 1.

View Models are a new addition in Magento 2. They encapsulate the business logic of a template, just like a Block, but they do not have any rendering logic. When using a View Model, the business logic is handled inside the View Model and the rendering of the template is handled by the Block. No business logic is added to the Block. 

#### `Console` folder

Magento 2 now has it's own CLI tool. New commands can be added and stored in here. 

#### `Controller` folder

Stores controllers, just like Magento 1. Controllers have changed a bit since then, so the internal architecture of this folder is a little different.

Controllers for `adminhtml` pages are stored in the `Adminhtml` sub-folder.

#### `Cron` folder

Stores classes which contain the logic for cron jobs.

#### `etc` folder

Just like Magento 1, config XML lives here. There is a lot more XML in Magento 2 and most of that (excluding layout XML) now lives in here too.

Config for different applciation areas (e.g. Cron, frontend, adminhtml) can be added by creating a sub-folder in this directory with the area name and adding a new config XML file, e.g. Instructions defined in `etc/adminhtml/di.xml` will only affect the adminhtml area and will override identical instructions in the global scope of `etc/di.xml`. 

However, some files can only be global (e.g. `acl.xml`), some can be area specific (e.g. `routes.xml` or `sections.xml`) and some can be both (`di.xml`).

Source: 

## Suggestions for further research

* How has class name resolution changed since Magento 1?