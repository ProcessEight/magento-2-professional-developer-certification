# ProcessEight AddMenuItemToMyAccountExample

## Purpose
A module to demonstrate how different areas of Magento are affected by Customer Groups.

Tested on Magento Open Source 2.2.5.

## Pricing

### Add a new tier price

Customer Groups can be assigned to tiered pricing tiers, so products can have different prices per customer group. 

#### Through the admin

Admin, Catalogue, Products, Choose product, Advanced Pricing.

Click the 'Add' button to add a new tier, then select the Customer Group from the drop-down menu.

#### Custom example

To add a new tier price programmatically requires four steps:

@todo

#### Core example

@todo

### Tax rules

Each Customer Group must be assigned to a single Tax Rule.

#### Through the admin

Admin, Customers, Customer Groups, Select Customer Group, Choose a Tax Rule from the drop-down menu.

#### Custom example

@todo

#### Core example

@todo

### Catalogue Price Rules

Groups of products can be discounted by creating a Catalogue Price Rule with a specific Customer Group.

#### Through the admin



#### Custom example

#### Core example

### Shopping Cart Price Rules

#### Through the admin


#### Custom example

#### Core example

