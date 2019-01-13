Tested on Magento 2.2.5.

## Exam

### Question
You have created a new Customer Address attribute to specify whether or not someone is at a residential address. Unfortunately, this new attribute is not appearing when you go to the frontend > My Account > Address Book > Edit. 

How do you solve this?

### Answers

#### Override Magento_Customer::address/edit.phtml.
CORRECT: Whilst attributes added to forms in the admin appear automatically, they need to be added to forms in the frontend manually. 

This is because there could be different themes on the frontend which Magento does not manage. 

#### Re-index the store.
INCORRECT: Whilst some attributes do invalidate indexes (especially catalog attributes), custom customer attributes do not.

So re-indexing will not make any difference in this case.

#### Clear the cache.
INCORRECT: Clearing the cache will not make `customer_address` attributes appear on the frontend, without manually adding them to a template first.

#### Add the attribute to the customer_address form (in customer_form_attribute).
INCORRECT: This is the red herring answer. It is necessary to add the attribute to the `customer_address_form`, but this does not make it automatically appear on the frontend. 

## Disclaimer
This module is intended as a learning aid only and is not intended for use in production systems.

## Copyright
&copy; 2019 ProcessEight
