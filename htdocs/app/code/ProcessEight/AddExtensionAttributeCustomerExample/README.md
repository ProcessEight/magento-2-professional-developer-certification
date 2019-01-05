# ProcessEight AddExtensionAttributeCustomerExample

## Purpose
A module to demonstrate how to add an extension attribute to the customer entity

Tested on Magento Open Source 2.2.5.

## Examples

Extension attributes work with any entity that extends `\Magento\Framework\Model\AbstractExtensibleModel`.

### Adding an extension attribute to the 'Customer' entity

#### Custom example

##### Adding the attribute

* Create `etc/extension_attributes.xml`:
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:framework:Api/etc/extension_attributes.xsd">
    <extension_attributes for="Magento\Customer\Api\Data\CustomerInterface">
    
    </extension_attributes>
</config>
```

* Add an interface which defines the getters and setters. In this example the interface adds an attribute called `processeight_customer_note`.
```php
<?php declare(strict_types=1);

namespace ProcessEight\AddExtensionAttributeCustomerExample\Api\Data;

interface CustomerNoteInterface
{
    const VALUE = 'value';

    /**
     * @return string
     */
    public function getValue() : string;

    /**
     * @param string $value
     *
     * @return CustomerNoteInterface
     */
    public function setValue(string $value) : CustomerNoteInterface;
}
```

* Add an `attribute` node with the `\ProcessEight\AddExtensionAttributeCustomerExample\Api\Data\CustomerNoteInterface` added to the `type` attribute:
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:framework:Api/etc/extension_attributes.xsd">
    <extension_attributes for="Magento\Customer\Api\Data\CustomerInterface">
        <attribute code="processeight_customer_note" type="ProcessEight\AddExtensionAttributeCustomerExample\Api\Data\CustomerNoteInterface"/>
    </extension_attributes>
</config>
```

* Add a concrete implementation of `\ProcessEight\AddExtensionAttributeCustomerExample\Api\Data\CustomerNoteInterface`
```php
<?php declare(strict_types=1);

namespace ProcessEight\AddExtensionAttributeCustomerExample\Model;

use ProcessEight\AddExtensionAttributeCustomerExample\Api\Data\CustomerNoteInterface;

class CustomerNote implements CustomerNoteInterface
{

    /**
     * @return string
     */
    public function getValue() : string
    {
        return $this->getData(self::VALUE);
    }

    /**
     * @param string $value
     *
     * @return CustomerNoteInterface
     */
    public function setValue(string $value) : CustomerNoteInterface
    {
        return $this->setData(self::VALUE, $value);
    }
}
```

* Add a preference to `di.xml` for `\ProcessEight\AddExtensionAttributeCustomerExample\Model\CustomerNote`
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <preference for="ProcessEight\AddExtensionAttributeCustomerExample\Api\Data\CustomerNoteInterface"
                type="ProcessEight\AddExtensionAttributeCustomerExample\Model\CustomerNote"/>
</config>
```

##### Loading the attribute values
* The preceding steps adds the extension attribute. However, loading the attributes' values and persisting them is left to the developer. A common approach is to use plugins.
* Add `after` plugins on the get and getList methods on the entities repository (and any other methods used to load the model):
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:framework:ObjectManager/etc/config.xsd">
    <!-- Plugins -->
    <type name="Magento\Customer\Api\CustomerRepositoryInterface">
        <plugin name="processeight_customer_repository_plugin"
                type="ProcessEight\AddExtensionAttributeCustomerExample\Plugin\CustomerRepositoryPlugin"/>
    </type>
</config>
```
Then define the plugins:
```php
<?php declare(strict_types=1);

namespace ProcessEight\AddExtensionAttributeCustomerExample\Plugin;

/**
 * Adds CustomerCode extension attribute to Customer Repository
 *
 * @see CustomerRepositoryInterface
 */
class CustomerRepositoryPlugin
{
    /**
     * @var \Magento\Customer\Api\Data\CustomerExtensionInterfaceFactory
     */
    private $customerExtensionFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * CustomerRepositoryPlugin constructor.
     *
     * @param \Magento\Customer\Api\Data\CustomerExtensionInterfaceFactory $customerExtensionFactory
     * @param \Psr\Log\LoggerInterface                                     $logger
     */
    public function __construct(
        \Magento\Customer\Api\Data\CustomerExtensionInterfaceFactory $customerExtensionFactory,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->customerExtensionFactory = $customerExtensionFactory;
        $this->logger                   = $logger;
    }

    /**
     * Add the processeight_customer_note extension attribute to the Customer entity when a customer is retrieved from the repository
     *
     * @see \Magento\Customer\Api\CustomerRepositoryInterface::get()
     *
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $subject
     * @param \Magento\Customer\Api\Data\CustomerInterface      $result
     *
     * @return \Magento\Customer\Api\Data\CustomerInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGet(
        \Magento\Customer\Api\CustomerRepositoryInterface $subject,
        \Magento\Customer\Api\Data\CustomerInterface $result
    ) : \Magento\Customer\Api\Data\CustomerInterface {
        $extensionAttributes = $this->getExtensionAttributes($result);
        $customerNote        = $this->getCustomerNote();

        try {
            $extensionAttributes->setProcesseightCustomerNote($customerNote);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
            $extensionAttributes->setProcesseightCustomerNote(null);
        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
        }

        return $result;
    }

    /**
     * Add the processeight_customer_note extension attribute to the Customer entity when a customer is retrieved from the repository
     *
     * @see \Magento\Customer\Api\CustomerRepositoryInterface::getById()
     *
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $subject
     * @param \Magento\Customer\Api\Data\CustomerInterface      $result
     *
     * @return \Magento\Customer\Api\Data\CustomerInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetById(
        \Magento\Customer\Api\CustomerRepositoryInterface $subject,
        \Magento\Customer\Api\Data\CustomerInterface $result
    ) : \Magento\Customer\Api\Data\CustomerInterface {
        $extensionAttributes = $this->getExtensionAttributes($result);
        $customerNote        = $this->getCustomerNote();

        try {
            $extensionAttributes->setProcesseightCustomerNote($customerNote);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
            $extensionAttributes->setProcesseightCustomerNote(null);
        } catch (\Exception $exception) {
            $this->logger->critical($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());
        }

        return $result;
    }

    /**
     * Add the processeight_customer_note extension attribute to the Customer entity when customers are retrieved from the repository
     *
     * @param \Magento\Customer\Api\CustomerRepositoryInterface         $subject
     * @param \Magento\Customer\Api\Data\CustomerSearchResultsInterface $results
     *
     * @see \Magento\Customer\Api\CustomerRepositoryInterface::getList()
     * @return \Magento\Customer\Api\Data\CustomerSearchResultsInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetList(
        \Magento\Customer\Api\CustomerRepositoryInterface $subject,
        $results
    ) : \Magento\Customer\Api\Data\CustomerSearchResultsInterface {
        if ($results->getTotalCount() <= 0) {
            return $results;
        }

        $customerNotes = $this->getAllCustomerNotes();

        foreach ($results->getItems() as $customer) {
            if (!isset($customerNotes[$customer->getId()])) {
                continue;
            }

            $extensionAttributes = $this->getExtensionAttributes($customer);
            $extensionAttributes->setProcesseightCustomerNote($customerNotes[$customer->getId()]);
        }

        return $results;
    }

    /**
     * Get a CustomerExtension object, creating it if it is not yet created
     *
     * @param \Magento\Customer\Api\Data\CustomerInterface $customer
     *
     * @return \Magento\Customer\Api\Data\CustomerExtensionInterface
     */
    private function getExtensionAttributes(\Magento\Customer\Api\Data\CustomerInterface $customer)
    {
        $extensionAttributes = $customer->getExtensionAttributes();
        if (!$extensionAttributes) {
            $extensionAttributes = $this->customerExtensionFactory->create();
            $customer->setExtensionAttributes($extensionAttributes);
        }

        return $extensionAttributes;
    }

    /**
     * The customer note could come from anywhere. It is hardcoded here for the purposes of this example
     *
     * @return string
     */
    private function getCustomerNote() : string
    {
        return 'This is a note added to an extension attribute';
    }

    /**
     * The customer notes could come from anywhere. They are hardcoded here for the purposes of this example
     *
     * @return string[]
     */
    private function getAllCustomerNotes() : array
    {
        $customerNotes = [
            1 => 'Notes for customer 1',
            2 => 'Notes for customer 2',
            3 => 'Notes for customer 3',
            4 => 'Notes for customer 4',
            5 => 'Notes for customer 5',
        ];

        return $customerNotes;
    }
}
```  

##### Saving the attribute values
* Persisting the attribute's values is left to the developer. A common approach is to use plugins:
* Add `after` plugins on the get and getList methods on the entities repository (and any other methods used to load the model):

#### Demonstration

Using a simple sandbox script, we can demonstrate that the extension attribute has been added to the customer entity:
```php
// htdocs/sandbox.php
<?php
require_once 'app/bootstrap.php';
$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);

/** @var \Magento\Framework\App\ObjectManager $objectManager */
$objectManager = \Magento\Framework\App\ObjectManager::getInstance();

/** @var \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository */
$customerRepository = $objectManager->create( \Magento\Customer\Api\CustomerRepositoryInterface::class);

$customer = $customerRepository->get('roni_cost@example.com');

var_dump($customer->getExtensionAttributes());
```

Which produces the following output:
```bash
$ php -f sandbox.php 
/var/www/vhosts/m2-professional-developer-certification/htdocs/sandbox.php:13:
class Magento\Customer\Api\Data\CustomerExtension#4147 (1) {
  protected $_data =>
  array(1) {
    'processeight_customer_note' =>
    string(46) "This is a note added to an extension attribute"
  }
}
``` 

#### Core example

Add one

#### Notes

Magento auto-generates a new interface with getters and setters which reflects the extension attribute definition:

```php
// htdocs/generated/code/Magento/Customer/Api/Data/CustomerExtensionInterface.php
<?php
namespace Magento\Customer\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Customer\Api\Data\CustomerInterface
 */
interface CustomerExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return \ProcessEight\AddExtensionAttributeCustomerExample\Api\Data\CustomerNoteInterface|null
     */
    public function getProcesseightCustomerNote();

    /**
     * @param \ProcessEight\AddExtensionAttributeCustomerExample\Api\Data\CustomerNoteInterface $processeightCustomerNote
     * @return $this
     */
    public function setProcesseightCustomerNote(\ProcessEight\AddExtensionAttributeCustomerExample\Api\Data\CustomerNoteInterface $processeightCustomerNote);
}
```

Magento generates the concrete implementation of the interface as well:
```php
// htdocs/generated/code/Magento/Customer/Api/Data/CustomerExtension.php
<?php
namespace Magento\Customer\Api\Data;

/**
 * Extension class for @see \Magento\Customer\Api\Data\CustomerInterface
 */
class CustomerExtension extends \Magento\Framework\Api\AbstractSimpleObject implements CustomerExtensionInterface
{
    // ... other getters and setters ...

    /**
     * @return \ProcessEight\AddExtensionAttributeCustomerExample\Api\Data\CustomerNoteInterface|null
     */
    public function getProcesseightCustomerNote()
    {
        return $this->_get('processeight_customer_note');
    }

    /**
     * @param \ProcessEight\AddExtensionAttributeCustomerExample\Api\Data\CustomerNoteInterface $processeightCustomerNote
     * @return $this
     */
    public function setProcesseightCustomerNote(\ProcessEight\AddExtensionAttributeCustomerExample\Api\Data\CustomerNoteInterface $processeightCustomerNote)
    {
        $this->setData('processeight_customer_note', $processeightCustomerNote);
        return $this;
    }
    
    // ... other getters and setters ...
}

```

#### Through the admin

It is not possible to edit extension attributes through the admin in Magento Open Source edition.
