# ProcessEight AddMenuItemToMyAccountExample

* [Purpose](#purpose)
* [Customising the 'My Account' section](#customising-the-my-account-section)
    * [Add a new menu item](#add-a-new-menu-item)
        * [Custom example](#custom-example)
        * [Core example](#core-example)
    * [Remove a menu item](#remove-a-menu-item)
        * [Custom example](#custom-example-1)
        * [Core example](#core-example-1)
    * [Group the menu items into separate sections](#group-the-menu-items-into-separate-sections)
        * [Custom example](#custom-example-2)
        * [Core example](#core-example-2)

## Purpose
A module to demonstrate how to add a new menu item to the navigation bar in 'My Account'.

## Customising the 'My Account' section

### Add a new menu item

#### Custom example

To add a new menu item requires four steps:

* Create a layout file named `customer_account.xml` in `view/frontend/layout`:
```xml
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
      xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body></body>
</page>

```

* Use a `referenceBlock` node to target the `customer_account_navigation` block:
```xml
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceBlock name="customer_account_navigation">
            
        </referenceBlock>
    </body>
</page>
```

* Insert a new block of type `Magento\Customer\Block\Account\SortLinkInterface` with a unique name. Our custom block is named `customer-account-navigation-custom-link` in this example:
```xml
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceBlock name="customer_account_navigation">
            <block class="Magento\Customer\Block\Account\SortLinkInterface"
                   name="customer-account-navigation-custom-link">
            </block>
        </referenceBlock>
    </body>
</page>
```

* Add argument nodes to the block to define the properties of the link. Only the `sortOrder` is actually defined in the `Magento\Customer\Block\Account\SortLinkInterface`:
 ```xml
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
     <body>
         <referenceBlock name="customer_account_navigation">
             <block class="Magento\Customer\Block\Account\SortLinkInterface"
                    name="customer-account-navigation-custom-link">
                 <arguments>
                     <argument name="label"
                               translate="true"
                               xsi:type="string">Custom Link</argument>
                     <argument name="path"
                               xsi:type="string">custom/link</argument>
                     <argument name="sortOrder"
                               xsi:type="number">200</argument>
                 </arguments>
             </block>
         </referenceBlock>
     </body>
 </page>
 ```
* `label`: Text used on frontend for the link. Visible to customer.
* `path`: Populates the `href` attribute of the generated `<a/>` tag.
* `sortOrder`: Defines ordering of links. Numbers closer to zero push the link further down the list of links.

#### Core example

The layout file used by the core is located at `htdocs/vendor/magento/module-customer/view/frontend/layout/customer_account.xml`.

### Remove a menu item

#### Custom example

* To remove a menu item, target the block using a `referenceBlock` node, then set the `remove` attribute to `true`:
```xml
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceBlock name="customer-account-navigation-custom-link"
                        remove="true"/>
    </body>
</page>
```

#### Core example

* For an example from the core, see `htdocs/vendor/magento/module-theme/view/frontend/layout/print.xml`. This layout file removes the top navigation bar block:
```xml
<?xml version="1.0"?>
<!--
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
-->
<page layout="1column" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        ...
        <referenceContainer name="header.container" remove="true"/>
        <referenceBlock name="catalog.topnav" remove="true"/>
        <referenceContainer name="footer-container" remove="true"/>
        ...
    </body>
</page>

```
As you can see, the same approach can also be used to remove entire containers (and, therefore, all contained blocks).

### Group the menu items into separate sections

#### Custom example

* Target the `customer_account_navigation` block using a `referenceBlock` node:
```xml
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceBlock name="customer_account_navigation">
            
        </referenceBlock>
    </body>
</page>
```
* Add your delimiter blocks to the menu:
```xml
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceBlock name="customer_account_navigation">
            <block class="Magento\Customer\Block\Account\Delimiter"
                   name="customer-account-navigation-notes-delimiter-1"
                   template="Magento_Customer::account/navigation-delimiter.phtml">
            </block>
            <block class="Magento\Customer\Block\Account\Delimiter"
                   name="customer-account-navigation-notes-delimiter-2"
                   template="Magento_Customer::account/navigation-delimiter.phtml">
            </block>
        </referenceBlock>
    </body>
</page>
```

* Define the template to be rendered. In this example, the template from the `Magento_Customer` core module (`account/navigation-delimiter.phtml`) is being re-used:
```html
<li class="nav item">
    <span class="delimiter"></span>
</li>
```

* Use the sortOrder argument to control which menu items are separated by this delimiter. In this example, all menu items with a `sortOrder` greater than 100 and less than 200 will be grouped between `customer-account-navigation-notes-delimiter-1` and `customer-account-navigation-notes-delimiter-2`:
```xml
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceBlock name="customer_account_navigation">
            <block class="Magento\Customer\Block\Account\Delimiter"
                   name="customer-account-navigation-notes-delimiter-1"
                   template="Magento_Customer::account/navigation-delimiter.phtml">
                <arguments>
                    <argument name="sortOrder" xsi:type="number">100</argument>
                </arguments>
            </block>
            <block class="Magento\Customer\Block\Account\Delimiter"
                   name="customer-account-navigation-notes-delimiter-2"
                   template="Magento_Customer::account/navigation-delimiter.phtml">
                <arguments>
                    <argument name="sortOrder" xsi:type="number">200</argument>
                </arguments>
            </block>
        </referenceBlock>
    </body>
</page>
```

#### Core example

See `htdocs/vendor/magento/module-customer/view/frontend/layout/customer_account.xml`:
```xml
<?xml version="1.0"?>
<!--
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
-->
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" layout="2columns-left" xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd" label="Customer My Account (All Pages)" design_abstraction="custom">
    <body>
        <referenceContainer name="sidebar.main">
            <block class="Magento\Framework\View\Element\Template" name="sidebar.main.account_nav" template="Magento_Theme::html/collapsible.phtml" before="-">
                <block class="Magento\Customer\Block\Account\Navigation" name="customer_account_navigation" before="-">
                    ...
                    <block class="Magento\Customer\Block\Account\SortLinkInterface" name="customer-account-navigation-account-link">
                        <arguments>
                            <argument name="label" xsi:type="string" translate="true">Account Dashboard</argument>
                            <argument name="path" xsi:type="string">customer/account</argument>
                            <argument name="sortOrder" xsi:type="number">250</argument>
                        </arguments>
                    </block>
                    <block class="Magento\Customer\Block\Account\Delimiter" name="customer-account-navigation-delimiter-1" template="Magento_Customer::account/navigation-delimiter.phtml">
                        <arguments>
                            <argument name="sortOrder" xsi:type="number">200</argument>
                        </arguments>
                    </block>
                    <block class="Magento\Customer\Block\Account\SortLinkInterface" name="customer-account-navigation-address-link">
                        <arguments>
                            <argument name="label" xsi:type="string" translate="true">Address Book</argument>
                            <argument name="path" xsi:type="string">customer/address</argument>
                            <argument name="sortOrder" xsi:type="number">190</argument>
                        </arguments>
                    </block>
                    <block class="Magento\Customer\Block\Account\SortLinkInterface" name="customer-account-navigation-account-edit-link">
                        <arguments>
                            <argument name="label" xsi:type="string" translate="true">Account Information</argument>
                            <argument name="path" xsi:type="string">customer/account/edit</argument>
                            <argument name="sortOrder" xsi:type="number">180</argument>
                        </arguments>
                    </block>
                    <block class="Magento\Customer\Block\Account\Delimiter" name="customer-account-navigation-delimiter-2" template="Magento_Customer::account/navigation-delimiter.phtml">
                        <arguments>
                            <argument name="sortOrder" xsi:type="number">130</argument>
                        </arguments>
                    </block>
                </block>
            </block>
        </referenceContainer>
    </body>
</page>
```

The `account/delimiter.phtml` couldn't be simpler:
```html
<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
?>
<li class="nav item">
    <span class="delimiter"></span>
</li>
```