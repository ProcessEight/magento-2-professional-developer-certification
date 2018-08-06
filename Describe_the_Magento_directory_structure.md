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



Source: 

## Suggestions for further research

* How does Magento know where to find modules?
* How does Magento load modules?
* How does Magento enable/disable modules? What effect does each operation have on the behaviour of modules?
* How does Magento load code which does not have a `composer.json`?
    * The file `htdocs/app/etc/NonComposerComponentRegistration.php` defines a list of non-composer components and then loops through them `include`ing each one.
    * This is analogous to how Magento 1's `functions.php` was loaded by `Mage.php`