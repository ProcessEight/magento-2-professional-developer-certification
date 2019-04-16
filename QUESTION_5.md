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

### Example from core
To do

### Custom example
To do

### Further notes
If any

### Points for further investigation
- What are the other kind of price types?
- What kinds of criteria affect the price rendering process (e.g. Taxes, discounts, etc)?
- Aside from `product.price.render.default`, what other price render blocks are there? How are they rendered?
- Are the results of price calculation triggered by the `render` method cached anywhere?

## Disclaimer
This module is intended as a learning aid only and is not intended for use in production systems.

_Tested on Magento 2.2.5._

## Copyright
&copy; 2019 ProcessEight
