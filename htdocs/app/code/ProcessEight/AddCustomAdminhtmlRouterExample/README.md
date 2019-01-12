# ProcessEight_AddCustomAdminhtmlRouterExample 

## Purpose
An example module demonstrating how to create a custom router in Magento 2.

Tested on Magento 2.2.5.

## Exam

### Question
You have created a router in `MyCompany/MyModule/etc/adminhtml/router.xml` (see code below). The URL you need to handle is: `/admin_dev/functionality/product/`. 

What controller action file path do you create?

```xml
<route id="mymodule" frontName="functionality">
    <module name="MyCompany_MyModule" before="Magento_Backend" />
</route>
```

### Answers

#### Controller/Functionality/Product/Index.php

INCORRECT: The path is missing the `Adminhtml` subfolder. `Functionality` is a red herring here. The `frontName` may be defined as `functionality` in the code sample, but it is not used to define any part of the Controller Action file path.

#### Controller/Product.php

INCORRECT: `Product` is the subfolder. The Action Controller filename should be `Index.php`. Also, the path is missing the `Adminhtml` subfolder. 

#### Controller/Product/Index.php

INCORRECT: The `Adminhtml` subfolder is missing.

#### Controller/Adminhtml/Product/Index.php

CORRECT. This is the correct answer because it includes the `Adminhtml` subfolder. 

### Explanation

#### Mapping URLs to file paths

The URL is split apart and used to form the file path to the Controller Action file.

Given a URL of `http://www.m2-professional-developer-certification.test/admin/customer/index/edit/`:

* The frontName is `customer`. This maps to:
    * `<Vendor_Name>/<Module_Name>/Controllers/Adminhtml/`
    * `Adminhtml` is appended because this frontName was defined within a `router` node with an id of `admin`.
* `index` maps to the `Index` subfolder of `Controllers`
    * `<Vendor_Name>/<Module_Name>/Controllers/Adminhtml/Index/`
* `edit` maps to the `Edit.php` Controller Action class.
    * `<Vendor_Name>/<Module_Name>/Controllers/Adminhtml/Index/Edit.php`

Note that the `<Vendor_Name>/<Module_Name>/Controllers/Adminhtml/` path is one of the few 'magic' locations in a Magento module. Magento will only look for admin controllers within this directory and nowhere else, therefore, all admin controllers for a module MUST be located within this directory.

@todo Do any of the other core Routers have this requirement? Is it possible for this to be a requirement of a custom Router?

## Disclaimer
This module is intended as a learning aid only and is not intended for use in production systems.

## Copyright
&copy; 2019 ProcessEight
