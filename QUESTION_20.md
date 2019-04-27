Tested on Magento 2.2.5.

## Exam

### Question
You are adding a new store configuration value and need it to be visible in the Global scope and the Store View scope. 

Which attributes do you add to make this work?

### Answers

Choose two.

#### showInStoreView="1"
INCORRECT: This is the red herring answer. This node does not exist. Magento does not use the term 'Store View' in Config XML. It should be `showInStore`.

#### showInWebsite="1"
INCORRECT: The website scope is neither global nor store-specific, so it is totally irrelevant here.

#### showInDefault="1"
CORRECT: `Default` is how Magento refers to the 'Global' scope in Config XML.

#### showInStore="1"
CORRECT: Magento does not use the term 'Store View' in Config XML. Instead it uses the term 'Store'.

## Disclaimer
This module is intended as a learning aid only and is not intended for use in production systems.

## Copyright
&copy; 2019 ProcessEight
