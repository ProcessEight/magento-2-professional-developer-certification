# ProcessEight AddCustomerEavAttributeExample

## Purpose
A module to demonstrate how to add new EAV attributes to the Customer entity.

Tested on Magento Open Source 2.2.5.

## Customising the 'Customer' entity

### Add a new EAV attribute

The only required attribute property for a Customer attribute is `attribute_code`. Any property not explicitly set will be automatically set to a default value before it is created.

#### Custom example

#### Core example

The layout file used by the core is located at `htdocs/vendor/magento/module-customer/view/frontend/layout/customer_account.xml`.

### Add EAV attributes of different types

#### Custom example

#### Core example

### Adding an attribute with static options

i.e. The options are effectively hard-coded.

#### Custom example

#### Core example

### Adding an attribute with dynamic options

i.e. The quantity and value of the options is not hardcoded. Use a source model (I think). 

#### Custom example

#### Core example

### Adding an attribute which uses custom backend/frontend/source, etc models

#### Custom example

#### Core example

How to define attribute with custom validation rules?
How to define attribute with different translations for multiple storefronts? (Hint: `\Magento\Eav\Model\ResourceModel\Entity\Attribute::_afterSave`)
How to define attribute with different values for multiple storefronts? (Hint: `htdocs/vendor/magento/module-eav/Model/ResourceModel/Attribute.php:116`)
* What caches need to be cleaned?
    * eav
    * full_page
* What indexes need to be re-indexed?
    * customer_grid

### Reference


## EAV

### EAV database tables

EAV attribute data is spread out across multiple tables, which follows a pattern (mostly).

Attribute properties shared across all EAV entities are stored in the `eav_attribute` table.
Each entity can also define extra attribute properties, which are stored in tables which follow the naming pattern `[entity_type_code]_eav_attribute`.
For example, customer attribute properties are stored in the `customer_eav_attribute` table.

This being Magento, of course, there are exceptions to this rule. Attribute properties for `catalog_product` and `catalog_category` share the same table: `catalog_eav_attribute`.

The actual values of an attribute are stored in tables which follow a similar naming pattern. The entity type code is concatenated with the backend type to produce the table name, i.e. `[entity_type_code]_entity_[backend_type]`. 
For example, a `catalog_product` attribute with a backend type of `varchar` would be stored in `catalog_product_entity_varchar`.

There is an exception to this convention as well. If an attribute has an entity type code of 'static', then that attribute isn't a true EAV attribute. 
Static attributes are represented as columns in the entity table, e.g. the `sku` attribute of the `catalog_product` entity. Static attribute values are saved against the entity table, 
so there is no typed table, e.g. There is no equivalent of `catalog_product_entity_varchar` for static attributes.
Since there are no joins required to retrieve the values of static attributes, they are much faster to load than EAV (which we can style as 'dynamic') attributes, 
which always require the typed table for each attribute backend_type to be joined to access those attribute values.

* `eav_entity_type`: Holds information about all EAV entities (Entities which can have attributes add to them):
```mysql
mysql> select * from eav_entity_type limit 1\G
*************************** 1. row ***************************
             entity_type_id: 1
           entity_type_code: customer
               entity_model: Magento\Customer\Model\ResourceModel\Customer
            attribute_model: Magento\Customer\Model\Attribute
               entity_table: customer_entity
         value_table_prefix: NULL
            entity_id_field: NULL
            is_data_sharing: 1
           data_sharing_key: default
   default_attribute_set_id: 1
            increment_model: Magento\Eav\Model\Entity\Increment\NumericValue
        increment_per_store: 0
       increment_pad_length: 8
         increment_pad_char: 0
 additional_attribute_table: customer_eav_attribute
entity_attribute_collection: Magento\Customer\Model\ResourceModel\Attribute\Collection
```
* `eav_attribute`: Holds metadata about attributes of all entity types:
```mysql
mysql> select * from eav_attribute limit 1\G
*************************** 1. row ***************************
   attribute_id: 1
 entity_type_id: 1
 attribute_code: website_id
attribute_model: NULL
  backend_model: Magento\Customer\Model\Customer\Attribute\Backend\Website
   backend_type: static
  backend_table: NULL
 frontend_model: NULL
 frontend_input: select
 frontend_label: Associate to Website
 frontend_class: NULL
   source_model: Magento\Customer\Model\Customer\Attribute\Source\Website
    is_required: 1
is_user_defined: 0
  default_value: NULL
      is_unique: 0
           note: NULL
```
* `eav_attribute_group`: Holds metadata about tabs which contain attributes:
```mysql
mysql> select * from eav_attribute_group limit 5;
+--------------------+------------------+----------------------+------------+------------+----------------------+----------------+
| attribute_group_id | attribute_set_id | attribute_group_name | sort_order | default_id | attribute_group_code | tab_group_code |
+--------------------+------------------+----------------------+------------+------------+----------------------+----------------+
|                  1 |                1 | General              |          1 |          1 | general              | NULL           |
|                  2 |                2 | General              |          1 |          1 | general              | NULL           |
|                  3 |                3 | General              |         10 |          1 | general              | NULL           |
|                  4 |                3 | General Information  |          2 |          0 | general-information  | NULL           |
|                  5 |                3 | Display Settings     |         20 |          0 | display-settings     | NULL           |
+--------------------+------------------+----------------------+------------+------------+----------------------+----------------+
5 rows in set (0.00 sec)
```

#### Common attribute properties

These properties are shared amongst all EAmodelsV entity types.

Default values of Common attribute properties:

| Property          | Alias             | Default value | Required  | Allowed values                        | Notes |
|---                |---                |---            |---        |---                                    |---    |
| attribute_code    | N/A               | N/A           | true      | Identifier can contain only `[a-z_]`  | Internal attribute identifier. Must be unique to attribute and cannot be a reserved word defined by Magento (see below). |
| attribute_model   | attribute_model   | NULL          | false     | Any valid class name                  | Contains logic for beforeSave/afterSave, beforeDelete/afterDelete events and other utility methods |
| backend_model     | backend           | NULL          | false     | Any valid class name                  | Applies transformations to the attribute value(s) before saving. | 
| backend_type      | type              | varchar       | false     | static, varchar, int, text, datetime, decimal | Defines the typed table where the attribute values are saved. |
| backend_table     | table             | NULL          | false     | ?                                     | Defines which table the attribute values are saved in. |
| frontend_model    | frontend          | NULL          | false     | Any valid class name                  | Applies transformations to the attribute value(s) before displaying to the end user. | 
| frontend_input    | input             | text          | NULL      | ?                                     | Defines which kind of HTML form control used to display the attribute. | 
| frontend_label    | label             | NULL          | false     | Any valid translatable string         | The attribute name that the end user sees. | 
| frontend_class    | frontend_class    | NULL          | false     | Any valid CSS class                   | ? | 
| source_model      | source            | NULL          | false     | Any valid class name                  | Allows to dynamically generate the allowed value(s) of the attribute. | 
| is_required       | required          | 1             | false     | 0,1                                   | Defines whether the attribute must be set when saving the entity. | 
| is_user_defined   | user_defined      | 0             | false     | 0,1                                   | Defines whether this is a system or user-defined attribute. System attributes cannot be deleted through the admin panel. | 
| default_value     | default           | NULL          | false     | Depends on attribute                  | The default value set against the attribute if a value is not explicitly set | 
| is_unique         | unique            | 0             | false     | 0,1                                   | Defines whether the attribute value should be unique among all instances of the entity (?) | 
| note              | note              | NULL          | false     | Any valid string                      | A comment which appears below the form control for the attribute in forms in the admin (if it is visible in the admin) | 
| is_global         | global            | SCOPE_GLOBAL* | false     | ?                                     | The scope that the attribute applies to | 

<blockquote>* Defined in `\Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL`</blockquote>

#### attribute_code

Internal attribute identifier. Never visible to the customer. 

Must be unique to attribute and cannot be a reserved word defined by Magento (see below).

Attribute codes can only contain the characters a-z and _. Upper-case letters and numbers are not allowed.

Codes must be a minimum of 1 character short and 30 characters long.

They cannot be changed once they have been created.

#### attribute_model

?

#### backend_model

The backend model contains logic to assist in saving, loading and deleting the attribute to/from the data store.

If an attribute does not have a backend model defined, Magento will use `\Magento\Eav\Model\Entity\Attribute\Backend\DefaultBackend` as the default backend model.

Default models for entities are defined in `\Magento\Eav\Model\Entity`.

These are the custom backend models used by core attributes:

```bash
mysql> select distinct(backend_model) from eav_attribute
+-----------------------------------------------------------------------+
| backend_model                                                         |
+-----------------------------------------------------------------------+
| Magento\Customer\Model\Customer\Attribute\Backend\Website             |
| Magento\Customer\Model\Customer\Attribute\Backend\Store               |
| Magento\Eav\Model\Entity\Attribute\Backend\Datetime                   |
| Magento\Customer\Model\Customer\Attribute\Backend\Password            |
| Magento\Customer\Model\Customer\Attribute\Backend\Billing             |
| Magento\Customer\Model\Customer\Attribute\Backend\Shipping            |
| Magento\Customer\Model\Attribute\Backend\Data\Boolean                 |
| Magento\Eav\Model\Entity\Attribute\Backend\DefaultBackend             |
| Magento\Customer\Model\ResourceModel\Address\Attribute\Backend\Region |
| Magento\Catalog\Model\Category\Attribute\Backend\Image                |
| Magento\Catalog\Model\Attribute\Backend\Startdate                     |
| Magento\Catalog\Model\Attribute\Backend\Customlayoutupdate            |
| Magento\Catalog\Model\Category\Attribute\Backend\Sortby               |
| Magento\Catalog\Model\Product\Attribute\Backend\Sku                   |
| Magento\Catalog\Model\Product\Attribute\Backend\Price                 |
| Magento\Catalog\Model\Product\Attribute\Backend\Weight                |
| Magento\Catalog\Model\Product\Attribute\Backend\Tierprice             |
| Magento\Catalog\Model\Product\Attribute\Backend\Category              |
| Magento\Catalog\Model\Product\Attribute\Backend\Stock                 |
| Magento\Catalog\Model\Product\Attribute\Backend\Boolean               |
| Magento\Eav\Model\Entity\Attribute\Backend\ArrayBackend               |
+-----------------------------------------------------------------------+
22 rows in set
Time: 0.021s
```

#### backend_type

Defines the typed table where the attribute values are saved.

Default types are static, varchar, int, text, datetime, decimal.

Attribute values are stored in tables which follow a similar naming pattern. 

The `entity_type_code` is concatenated with the `backend_type` to produce the table name, i.e. `[entity_type_code]_entity_[backend_type]`.
 
For example, a `catalog_product` attribute with a backend type of `varchar` would be saved in `catalog_product_entity_varchar`.

There is an exception to this convention. If an attribute has an entity type code of 'static', then that attribute isn't a true EAV attribute.
 
Static attributes are represented as columns in the entity table, e.g. the `sku` attribute of the `catalog_product` entity. 

Static attribute values are saved against the entity table, so there is no need of a typed table for them, e.g. There is no equivalent of `catalog_product_entity_varchar` for static attributes.

Since there are no joins required to retrieve the values of static attributes, they are much faster to load than EAV (which we can style as 'dynamic') attributes, 
which always require the typed table for each attribute `backend_type` to be joined to access those attribute values.

#### backend_table

?

#### Customer entity-specific attribute properties

These properties are defined in the `customer_eav_attribute` table.

Default values of customer attribute properties:
```php
array (
  'is_visible' => 1,
  'is_system' => 1,
  'input_filter' => NULL,
  'multiline_count' => 0,
  'validate_rules' => NULL,
  'data_model' => NULL,
  'sort_order' => 0,
  'is_used_in_grid' => 0,
  'is_visible_in_grid' => 0,
  'is_filterable_in_grid' => 0,
  'is_searchable_in_grid' => 0,
)
```

| Property          | Alias             | Default value | Required  | Allowed values                        | Notes |
|---                |---                |---            |---        |---                                    |---    |
| is_system | system |   |   |   | If attribute is_system will add to all existing attribute sets |

### Assigning attribute to form(s)

The attribute must be created first, then it can be assigned to forms (TODO: verify this).

The list of forms to which customer attributes can be assigned is defined in the `customer_form_attribute` table:
```bash
mysql> select distinct(form_code) from customer_form_attribute;
+----------------------------+
| form_code                  |
+----------------------------+
| adminhtml_checkout         |
| adminhtml_customer         |
| adminhtml_customer_address |
| customer_account_create    |
| customer_account_edit      |
| customer_address_edit      |
| customer_register_address  |
+----------------------------+
7 rows in set
Time: 0.005s
```
This table also contains the form - attribute ID association:
```bash
mysql> select * from customer_form_attribute limit 5;
+-------------------------+--------------+
| form_code               | attribute_id |
+-------------------------+--------------+
| adminhtml_customer      | 1            |
| adminhtml_customer      | 3            |
| adminhtml_customer      | 4            |
| customer_account_create | 4            |
| customer_account_edit   | 4            |
+-------------------------+--------------+
5 rows in set
Time: 0.020s
```
Records are inserted into this table in the `\Magento\Eav\Model\ResourceModel\Attribute::_afterSave` method.

## Validation

The minimum and maximum lengths of an attribute are defined in `\Magento\Eav\Model\Entity\Attribute::ATTRIBUTE_CODE_MIN_LENGTH` and `\Magento\Eav\Model\Entity\Attribute::ATTRIBUTE_CODE_MAX_LENGTH`.

If the `group` field is not set or the `user_defined` field is empty, then the attribute will be added to all attribute sets for that entity.

Attributes must not use an attribute code which has been reserved by Magento:

```php
array (
  'position' => 'position',
  0 => 'store_id',
  1 => 'resource_collection',
  2 => 'url_model',
  3 => 'name',
  4 => 'price',
  5 => 'visibility',
  6 => 'attribute_set_id',
  7 => 'created_at',
  8 => 'updated_at',
  10 => 'status',
  11 => 'type_instance',
  12 => 'link_instance',
  13 => 'id_by_sku',
  14 => 'category_id',
  15 => 'category',
  16 => 'category_ids',
  17 => 'category_collection',
  18 => 'website_ids',
  19 => 'store_ids',
  20 => 'attributes',
  21 => 'qty',
  22 => 'price_model',
  23 => 'price_info',
  24 => 'tier_prices',
  25 => 'tier_price',
  26 => 'formated_price',
  27 => 'final_price',
  29 => 'minimal_price',
  30 => 'special_price',
  31 => 'special_from_date',
  32 => 'special_to_date',
  33 => 'related_products',
  34 => 'related_product_ids',
  35 => 'related_product_collection',
  36 => 'related_link_collection',
  37 => 'up_sell_products',
  38 => 'up_sell_product_ids',
  39 => 'up_sell_product_collection',
  40 => 'up_sell_link_collection',
  41 => 'cross_sell_products',
  42 => 'cross_sell_product_ids',
  43 => 'cross_sell_product_collection',
  44 => 'cross_sell_link_collection',
  45 => 'product_links',
  46 => 'media_attributes',
  47 => 'media_attribute_values',
  48 => 'media_gallery_images',
  49 => 'media_config',
  50 => 'visible_in_catalog_statuses',
  51 => 'visible_statuses',
  52 => 'visible_in_site_visibilities',
  53 => 'is_salable',
  54 => 'attribute_text',
  55 => 'custom_design_date',
  56 => 'product_url',
  57 => 'url_in_store',
  59 => 'gift_message_available',
  60 => 'sku',
  61 => 'weight',
  62 => 'option_instance',
  63 => 'option_by_id',
  64 => 'product_options_collection',
  65 => 'options',
  66 => 'is_virtual',
  67 => 'custom_options',
  68 => 'custom_option',
  69 => 'available_in_categories',
  70 => 'default_attribute_set_id',
  71 => 'cache_id_tags',
  72 => 'preconfigured_values',
  73 => 'product_entities_info',
  74 => 'image',
  75 => 'identities',
  76 => 'extension_attributes',
  77 => 'media_gallery_entries',
  78 => 'id',
  79 => 'quantity_and_stock_status',
  80 => 'stock_data',
  81 => 'cache_tags',
  82 => 'locked_attributes',
  83 => 'store',
  84 => 'website_store_ids',
  85 => 'attribute_default_value',
  86 => 'exists_store_value_flag',
  87 => 'custom_attributes',
  88 => 'custom_attribute',
  89 => 'data',
  90 => 'id_field_name',
  91 => 'orig_data',
  92 => 'resource_name',
  93 => 'collection',
  94 => 'resource',
  95 => 'entity_id',
  96 => 'stored_data',
  97 => 'event_prefix',
  98 => 'data_by_path',
  99 => 'data_by_key',
  100 => 'data_using_method',
)
```