# ProcessEight CustomiseMyAccountOrderHistoryExample

* [Purpose](#purpose)
* [Customising the 'My Orders' section](#customising-the-my-orders-section)
    * [Extension point one: Adding content above the order grid](#extension-point-one-adding-content-above-the-order-grid)
        * [Custom example](#custom-example)
        * [Core example](#core-example)
    * [Extension point two: Adding a new column](#extension-point-two-adding-a-new-column)
        * [Custom example](#custom-example-1)
        * [Core example](#core-example-1)
        
## Purpose
A module to demonstrate how to customise the 'My Orders' section in 'My Account'.

Tested on Magento Open Source 2.2.5.

## Customising the 'My Orders' section

### Extension point one: Adding content above the order grid

#### Through the admin

It is not possible to perform this kind of customisation through the admin.

#### Custom example
* Create a new layout file, `view/frontend/layout/sales_order_history.xml`
* Add a new `referenceContainer` node, targeting the `sales.order.history.info` container
* Add a new block with a template containing your content

#### Core example
* No blocks in core target the `sales.order.history.info` container

### Extension point two: Adding a new column

#### Through the admin

It is not possible to perform this kind of customisation through the admin.

#### Custom example
* In the layout file, `view/frontend/layout/sales_order_history.xml`
* Add a new `referenceContainer` node, targeting the `sales.order.history.extra.column.header` container
* Add a new block with a template containing the table header (`<th>`) row for the new column header
* Add a new `referenceBlock` node to the layout file, targeting the `sales.order.history.extra.container` block
* Add a new block with a template containing the table data (`<td>`) row for the new column
* The order object is assigned to the child blocks of the `sales.order.history.extra.container` in the `htdocs/vendor/magento/module-sales/view/frontend/templates/order/history.phtml:32` template

#### Core example
* No blocks in core target the `sales.order.history.extra.column.header` container or the `sales.order.history.extra.container` block
