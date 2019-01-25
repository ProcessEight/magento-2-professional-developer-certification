# ProcessEight AddCustomerEavAttributeToFormsExample

## Purpose
A module to demonstrate how to add EAV attributes to forms in the frontend/admin.

Tested on Magento Open Source 2.2.5.

## Customising the 'Customer' entity

### Add an EAV attribute to a form

Customer attributes do not need to be added to forms. Adding an attribute to a form is only necessary if it needs to be visible in the admin or on the frontend.

#### Custom example

See `htdocs/app/code/ProcessEight/AddCustomerEavAttributeToFormsExample/Setup/UpgradeData.php:88`

#### Core example

See `htdocs/vendor/magento/module-customer/Setup/UpgradeData.php:602`

#### Through the admin

It is not possible to edit Customer entity attributes through the admin in Magento Open Source edition.

### Remove an EAV attribute from a form

This works in exactly the same way as adding - just assign the form codes to the attribute, excluding any forms you don't want the attribute to be assigned to.

When Magento saves the attribute, it deletes all the records for the attribute from the `customer_form_attribute` table, then inserts new ones.
