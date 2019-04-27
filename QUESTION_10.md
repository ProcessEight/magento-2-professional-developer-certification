## Exam

### Question

You have created a new product type, `sample`, and need to customize how it renders on the shopping cart page.

Keeping maintainability in mind, how do you add a new renderer?

### Answers

Choose one.

#### Override the cart/form.phtml template and add logic for the sample product type.

INCORRECT: 

#### Create the layout file, checkout_cart_index.xml, and reference the checkout.cart.renderers block and add a block with the as="sample" attribute.

INCORRECT: 

#### Create the layout file, checkout_cart_index.xml, and update the cart page's uiComponent to appropriately render the sample product type.

INCORRECT:  

#### Create the layout file, checkout_cart_item_renderers.xml, reference the checkout.cart.item.renderers block and add a new block with an as="sample" attribute.

CORRECT:  

### Example from core
To do

### Custom example
To do

### Further notes
If any

### Points for further investigation

## Disclaimer
This module is intended as a learning aid only and is not intended for use in production systems.

_Tested on Magento 2.3.1_

## Copyright
&copy; 2019 ProcessEight
