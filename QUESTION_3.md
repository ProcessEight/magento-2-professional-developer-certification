Tested on Magento 2.2.5.

## Exam

### Question
How do you configure a store configuration field to obscure input (password entry) and store that value securely?

### Answers

Choose two.

#### Set the field’s encryption_model node to be Magento\Config\Model\Config\EncryptedInterface.

INCORRECT: 

#### Set the type=”obscure”.

CORRECT: 

#### Add the attribute encrypted=”1”.

INCORRECT:  

#### Set the field’s backend_model node to be Magento\Config\Model\Config\Backend\Encrypted.

CORRECT:  

### Further notes

## Disclaimer
This module is intended as a learning aid only and is not intended for use in production systems.

## Copyright
&copy; 2019 ProcessEight
