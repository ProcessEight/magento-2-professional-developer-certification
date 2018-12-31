# ProcessEight AddCustomerEavAttributeToFormsExample

## Purpose
A module to demonstrate how to add new EAV attributes to the Customer entity.

Tested on Magento Open Source 2.2.5.

## Customising the 'Customer' entity

### Add a new EAV attribute

The only required attribute property for a Customer attribute is `attribute_code`. 

Any property not explicitly set will be automatically set to a default value before it is created.

Customer attributes do not need to be added to forms. Adding an attribute to a form is only necessary if it needs to be visible in the admin or on the frontend.

#### Custom example

See `htdocs/app/code/ProcessEight/AddCustomerEavAttributeToFormsExample/Setup/InstallData.php`

#### Core example

See `htdocs/vendor/magento/module-customer/Setup/UpgradeData.php:602`

### Add EAV attributes of different types

#### Custom example

#### Core example

### Adding an attribute with static options

i.e. The options are effectively hard-coded.

#### Custom example

#### Core example

### Adding an attribute with dynamic options

i.e. The quantity and value of the options is not hardcoded. Use a source model (I think). 

#### Custom example

#### Core example

### Adding an attribute which uses custom backend/frontend/source, etc models

#### Custom example

#### Core example
