# ProcessEight SalesOperationsOrderProcessing

@todo Add TOC here

## Purpose
A module to demonstrate how to customise the order processing flow.

Tested on Magento Open Source 2.2.5.

## Customising the order processing flow

The default order processing flow goes like:
* Order is created with `\Magento\Sales\Model\Order::STATE_NEW` state.
* Invoice is created. State is updated to `\Magento\Sales\Model\Order::STATE_PROCESSING`
* Shipment is created. State is updated to `\Magento\Sales\Model\Order::STATE_COMPLETE`
* Order is only completed once it has been both invoiced and shipped

Payment methods can also put the order into one of the following states:
* `\Magento\Sales\Model\Order::STATE_PENDING_PAYMENT`: If an offline payment method is used, then the order is created with this state.
* `\Magento\Sales\Model\Order::STATE_PAYMENT_REVIEW`: If an online payment method is used and the payment triggers any of the payment gateways' fraud-checking logic.

Additional steps include:
* Credit memo is placed. State is updated to `\Magento\Sales\Model\Order::STATE_CLOSED`
* Order is placed on hold. Can happen at any point (@todo Confirm when order is placed on hold and what happens). State is updated to `\Magento\Sales\Model\Order::STATE_HOLDED`
* Order is cancelled. Can happen at any point (@todo Confirm when order can be cancelled and what happens). State is updated to `\Magento\Sales\Model\Order::STATE_CANCELED`

#### Order state vs. Order status

An Order State is a stage which the order must pass through for it be processed. Moving from one stage to another updates the Order State.

An Order Status is just a label which maps to an Order State. Multiple Order Statuses can map to a single Order State. (@todo Confirm this definition)

### Add a new menu item

#### Through the admin


#### Custom example


#### Core example


### Remove a menu item

#### Through the admin


#### Custom example


#### Core example


### Group the menu items into separate sections

#### Through the admin


#### Custom example


#### Core example
