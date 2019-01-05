<?php declare(strict_types=1);
/**
 * ProcessEight
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please contact ProcessEight for more information.
 *
 * @package     ProcessEight\AddExtensionAttributeCustomerExample
 * @copyright   Copyright (c) 2019 ProcessEight
 * @author      ProcessEight
 *
 */

namespace ProcessEight\AddExtensionAttributeCustomerExample\Plugin;

/**
 * Adds processeight_customer_note extension attribute to Customer entities loaded through the Repository
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
    private function getExtensionAttributes(
        \Magento\Customer\Api\Data\CustomerInterface $customer
    ) : \Magento\Customer\Api\Data\CustomerExtensionInterface {
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
