Tested on Magento 2.2.5.

## Exam

### Question

You are tasked with creating a widget that will render a product’s price using the Magento price rendering system. 

How do you do this?

### Answers

Choose one.

#### Retrieve the product.price.render.default block and call the render method.

CORRECT: 

#### Use dependency injection to get an instance of the Magento\Framework\Pricing\Renderer class and call the renderPrice method.

INCORRECT: 

#### Trigger the catalog_product_render_price event, attaching the product as event data.

INCORRECT:  

#### Use the protected property, $priceRenderer injected in the $context in the Template.

INCORRECT:  

### Further notes

## Disclaimer
This module is intended as a learning aid only and is not intended for use in production systems.

## Copyright
&copy; 2019 ProcessEight
