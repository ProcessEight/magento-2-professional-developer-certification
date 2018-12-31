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
 * @package     ProcessEight\AddCustomerEavAttributeExample
 * @copyright   Copyright (c) 2017 ProcessEight
 * @author      ProcessEight
 *
 */

namespace ProcessEight\AddCustomerEavAttributeExample\Setup;

use Magento\Customer\Setup\CustomerSetupFactory;
use Magento\Customer\Model\Customer;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Entity\Attribute\SetFactory as AttributeSetFactory;

class InstallData implements InstallDataInterface
{
    /**
     * Customer setup factory
     *
     * @var CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * Attribute Set factory
     *
     * @var AttributeSetFactory
     */
    private $attributeSetFactory;

    /**
     * Constructor
     *
     * @param CustomerSetupFactory $customerSetupFactory
     * @param AttributeSetFactory  $attributeSetFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory,
        AttributeSetFactory $attributeSetFactory
    ) {
        $this->customerSetupFactory = $customerSetupFactory;
        $this->attributeSetFactory  = $attributeSetFactory;
    }

    /**
     * Creates a new attribute 'processeight_nickname' and adds it to the Customer entity and the admin Manage Customer form
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     *
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $attributeCode  = 'processeight_nickname';
        /** @var \Magento\Customer\Setup\CustomerSetup $customerSetup */
        $customerSetup  = $this->customerSetupFactory->create(['setup' => $setup]);
        $customerEntity = $customerSetup->getEavConfig()->getEntityType(Customer::ENTITY);

        // None of these are required. If none are set, Magento will set them to safe default values in
        // \Magento\Eav\Model\Entity\Setup\PropertyMapper for all entities (there are other mappers for other entities as well)
        $eavEntityCommonProperties = [
//            'backend'         => null,
//            'type'            => 'varchar', // static, varchar, int, text, datetime, decimal
//            'table'           => null,
//            'frontend'        => null,
//            'input'           => 'text',    // select, text, date, hidden, boolean, multiline, textarea, image, multiselect, price, weight, media_image, gallery
//            'label'           => 'Nickname',
//            'frontend_class'  => null,
//            'source'          => null,
//            'required'        => 0,
//            'user_defined'    => 1,
//            'default'         => null,
//            'unique'          => 0,
//            'note'            => null,
//            'global'          => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
//            'position'        => 10,
//            'group'           => 'Account Information', // Label of tab the attribute appears in
        ];

        // None of these are required. If none are set, Magento will set them to safe default values in
        // \Magento\Customer\Model\ResourceModel\Setup\PropertyMapper (for customer entities).
        // There are other mappers for other entities as well.
        $customerEntitySpecificProperties = [
//            'data_model'      => null,
//            'input_filter'    => null,
//            'multiline_count' => 0,
//            'sort_order'      => 10,
//            'system'          => 0,
//            'validate_rules'  => null,
//            'visible'         => 1,
//                 These options control the behaviour of the attribute in admin grids
//            'is_used_in_grid'       => true,
//            'is_filterable_in_grid' => true,
//            'is_searchable_in_grid' => true,
        ];

        $data = array_merge($eavEntityCommonProperties, $customerEntitySpecificProperties);

        $attributeSetId = $customerEntity->getDefaultAttributeSetId();
        /** @var $attributeSet \Magento\Eav\Model\Entity\Attribute\Set */
        $attributeSet     = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);
        $customerSetup->addAttribute(Customer::ENTITY, $attributeCode, $data);

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

        $customerAttribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, $attributeCode);
        $customerAttribute->addData([
            'attribute_set_id'      => $attributeSetId,
            'attribute_group_id'    => $attributeGroupId,
            /*
             * This tells magento to add the attribute to the following forms:
             *
             * adminhtml_customer:      The edit customer form in the admin
             * customer_account_create: The register form in the frontend
             * customer_account_edit:   The edit account information form in the 'My Account' area of the frontend
             */
            'used_in_forms'         => ['adminhtml_customer', 'customer_account_create', 'customer_account_edit',],
        ]);
        $customerAttribute->save();
    }
}
