Tested on Magento 2.2.5.

## Exam

### Question
You need to fetch the product names for all simple, enabled products.

What Magento feature do you use?

### Answers

#### Repository
INCORRECT: Repositories are intended to be used across Service boundaries (e.g. When a module in the 'Sales' Service requires data from the 'Catalog' Service).

#### Collection
CORRECT: Collections are intended to be used within Service boundaries, e.g. Within any module inside the 'Catalog' Service (this includes `Magento_Catalog`, `Magento_CatalogRule`, `Magento_CatalogUrlRewrite`, etc).

#### Resource Model
INCORRECT: Resource Models are classes which encapsulate the logic required to communicate with the data store. 

They are used by Collection classes, but should not be used to retrieve groups of models. That's what Collections are for.

#### Helper
INCORRECT: Helpers have nothing at all to do with retrieving data from the data store. The use of helpers is discouraged in Magento 2.

## Disclaimer
This module is intended as a learning aid only and is not intended for use in production systems.

## Copyright
&copy; 2019 ProcessEight
