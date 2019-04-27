## Exam

### Question

You are making some major adjustments to a core Magento class (`ClassA`). These adjustments are only necessary when utilized from a specific Magento class (`ClassB`). You have created MyClass that contains the needed customizations.

Keeping upgradeability in mind, how do you configure `di.xml` to make the substitution happen?

### Answers

Choose one.

#### Create a virtual type that extends `ModuleB`, specifying an `<argument/>` for MyClass.
INCORRECT: 
#### Ensure that `MyClass` extends `ModuleA` and set the `<argument/>`, for `ModuleB` to point to your new class in `di.xml`.
CORRECT:  
#### Create a rewrite node that injects `MyClass` into `ClassB`.
INCORRECT: 
#### Set a `<preference/>` for `ModuleA` to be replaced by `MyClass`
INCORRECT:  

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
