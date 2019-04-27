## Exam

### Question
What container contains the columns container?

### Answers

Choose one.

#### page.wrapper

INCORRECT: Almost correct. `page.wrapper` contains `main.content`, which in turn contains the `columns` container.

#### main.content

CORRECT: `main.content` contains the `columns` container.

#### main

INCORRECT: Almost correct. `main` is contained by the `columns` container.

#### columns.wrapper

INCORRECT: Whilst it sounds obvious, there is no such container by the name `columns.wrapper` in the core codebase.

### Example from core

File: `htdocs/vendor/magento/module-theme/view/base/page_layout/empty.xml`
```xml
<?xml version="1.0"?>
<layout xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
        xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_layout.xsd">
    <container name="root">
        <container name="after.body.start" as="after.body.start" before="-" label="Page Top"/>
        <!-- `page.wrapper` contains `main.content`, which in turn contains the `columns` container. -->
        <container name="page.wrapper" as="page_wrapper" htmlTag="div" htmlClass="page-wrapper">
            <container name="global.notices" as="global_notices" before="-"/>
            <!-- `main.content` contains the `columns` container. -->
            <container name="main.content" htmlTag="main" htmlId="maincontent" htmlClass="page-main">
                <container name="columns.top" label="Before Main Columns"/>
                <container name="columns" htmlTag="div" htmlClass="columns">
                    <!-- `main` is contained by the `columns` container. -->
                    <container name="main" label="Main Content Container" htmlTag="div" htmlClass="column main"/>
                </container>
            </container>
            <container name="page.bottom.container" as="page_bottom_container" label="Before Page Footer Container" after="main.content" htmlTag="div" htmlClass="page-bottom"/>
            <container name="before.body.end" as="before_body_end" after="-" label="Page Bottom"/>
        </container>
    </container>
</layout>
```

### Custom example

To do

### Further notes

All the default frontend `page_layout`s (`frontend/page_layout/1column.xml`,`frontend/page_layout/2columns-left.xml`, `frontend/page_layout/2columns-right.xml`, `frontend/page_layout/3columns.xml`) use the `update` Layout XML instruction to 'include' the base `page_layout` from `base/page_layout/empty.xml`. It is `empty.xml` which contains the single reference to the `columns` container.

The adminhtml `page_layout`s do not use the `base/page_layout/empty.xml` file at all.

### Points for further investigation

- What is a `page_layout`?
- What is a `container`?
- What is its purpose?
- What is the purpose of `empty.xml`?
- How would one go about adding a new `page_layout`? Would it be necessary to include `empty.xml` in a custom `page_layout`?
- How does the `columns` container differ in a `page_layout` with more than one column (e.g. `2columns-left.xml`)?

_Tested on Magento 2.2.5._
