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
 * @package     ProcessEight\AddCustomerEavAttributeToFormsExample
 * @copyright   Copyright (c) 2017 ProcessEight
 * @author      ProcessEight
 *
 */

namespace ProcessEight\AddCustomerEavAttributeToFormsExample\Setup;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * Customer setup factory
     *
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * Constructor
     *
     * @param CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * Adds the attribute 'processeight_nickname' to the admin Manage Customer form
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $attributeCode = 'processeight_nickname';
        /** @var \Magento\Customer\Setup\CustomerSetup $customerSetup */
        $customerSetup     = $this->customerSetupFactory->create(['setup' => $setup]);
        $customerAttribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, $attributeCode);

        /*
         *  Note you only need to worry about form codes if the customer attribute is_system == 0 and is_visible == 1
         *
         *  mysql> select distinct(form_code) from customer_form_attribute;
         *  +----------------------------+
         *  | form_code                  |
         *  +----------------------------+
         *  | adminhtml_checkout         |
         *  | adminhtml_customer         |
         *  | adminhtml_customer_address |
         *  | checkout_register          |
         *  | customer_account_create    |
         *  | customer_account_edit      |
         *  | customer_address_edit      |
         *  | customer_register_address  |
         *  +----------------------------+
         *  8 rows in set (0.00 sec)
         */

        $customerAttribute->addData([
            /*
             * This tells magento to add the attribute to the following forms:
             *
             * adminhtml_customer:      The edit customer form in the admin
             * customer_account_create: The register form in the frontend
             * customer_account_edit:   The edit account information form in the 'My Account' area of the frontend
             */
            'used_in_forms' => ['adminhtml_customer', 'customer_account_create', 'customer_account_edit',],
        ]);
        $customerAttribute->save();
    }
}
