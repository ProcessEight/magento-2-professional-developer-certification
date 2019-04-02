Tested on Magento 2.2.5.

## Exam

### Question
How do you configure a store configuration field to obscure input (password entry) and store that value securely?

### Answers

Choose two.

#### Set the field’s encryption_model node to be Magento\Config\Model\Config\EncryptedInterface.

INCORRECT: This is the almost-correct answer. The node `encryption_model` does not exist in the core. Neither does `Magento\Config\Model\Config\EncryptedInterface`. There is a `\Magento\Config\Model\Config\Backend\Encrypted`, but note that it is in the `Backend` folder, as all models which deal with saving/loading attribute values should be.

#### Set the type=”obscure”.

CORRECT: The question gives it away - the type node should be set to `obscure`. Magento will then 'obscure' the values entered in this field by replacing the characters with asterisks. The backend model `Magento\Config\Model\Config\Backend\Encrypted` encrypts the value before saving and decrypts it after loading.

#### Add the attribute encrypted=”1”.

INCORRECT: There is no such attribute or node in the core. 

#### Set the field’s backend_model node to be Magento\Config\Model\Config\Backend\Encrypted.

CORRECT: This is the second part of the correct answer. Defining the `backend_model` node to use the `Magento\Config\Model\Config\Backend\Encrypted` backend model is the correct way to 'store a value securely'. The type node has to be set to `obscure` as well.

### Example

This example in the `module-dhl` adds a password field to the system config:

```xml
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Config:etc/system_file.xsd">
    <system>
        <section id="carriers">
            <group id="dhl" translate="label" type="text" sortOrder="140" showInDefault="1" showInWebsite="1" showInStore="1">
                <!-- ... other fields omitted for breviy ... -->
                <field id="password" translate="label" type="obscure" sortOrder="60" showInDefault="1" showInWebsite="1" showInStore="0">
                    <label>Password</label>
                    <backend_model>Magento\Config\Model\Config\Backend\Encrypted</backend_model>
                </field>
              ```

## Copyright
&copy; 2019 ProcessEight
