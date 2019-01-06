# ProcessEight AddCustomerEavAttributeExample

## Purpose
A module to demonstrate how to add new EAV attributes to the Customer Address entity.

Tested on Magento Open Source 2.2.5.

## Customising the 'Customer Address' entity

### Add a new EAV attribute

The only required attribute property for a Customer attribute is `attribute_code`. 

Any property not explicitly set will be automatically set to a default value before it is created.

Customer Address attributes do not need to be added to forms. Adding an attribute to a form is only necessary if it needs to be visible/editable in the admin or on the frontend.

Beware that if you add an attribute to an entity which is required and without a default value but is not added to a form, then it may be impossible to save the entity on the frontend (e.g. When the customer creates a new account or a new address on the frontend) because Magento requires the attribute to have a value, but the customer has no means to give it one.

#### Through the admin

It is not possible to edit Customer Address entity attributes through the admin in Magento Open Source edition.

#### Custom example

* Create the attribute:
```php

```
* Plugin/override the frontend layout for referenceContainer form.additional.info
* Add a template phtml file to show the additional attribute(s)
* Add a block class/view model to load the new attributes and create the html

See `htdocs/app/code/ProcessEight/AddCustomerEavAttributeExample/Setup/InstallData.php`

#### Core example

See `htdocs/vendor/magento/module-customer/Setup/UpgradeData.php:602`

### Add EAV attributes of different types

@todo

#### Through the admin

It is not possible to edit Customer entity attributes through the admin in Magento Open Source edition.

#### Custom example
@todo

#### Core example
@todo

### Adding an attribute with static options

i.e. The options are effectively hard-coded.

@todo

#### Through the admin

It is not possible to edit Customer entity attributes through the admin in Magento Open Source edition.

#### Custom example
@todo

#### Core example
@todo

### Adding an attribute which uses custom backend/frontend/source, etc models

#### Through the admin

It is not possible to edit Customer entity attributes through the admin in Magento Open Source edition.

#### Custom example
@todo

#### Core example
@todo
