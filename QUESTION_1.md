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

To do

### Custom example

To do

### Further notes

All the default frontend `page_layout`s (`frontend/page_layout/1column.xml`,`frontend/page_layout/2columns-left.xml`, `frontend/page_layout/2columns-right.xml`, `frontend/page_layout/3columns.xml`) use the `update` Layout XML instruction to 'include' the base `page_layout` in `base/page_layout/empty.xml`. It is `empty.xml` which contains the single reference to the `columns` container.

The adminhtml `page_layout`s do not use the `base/page_layout/empty.xml` file at all.

### Points for further investigation

- What is a `container`?
- What is its purpose?
- What is the purpose of `empty.xml`?
- How would one go about adding a new `page_layout`? Would it be necessary to include `empty.xml` in a custom `page_layout`?
- How does the `columns` container differ in a `page_layout` with more than one column (e.g. `2columns-left.xml`)?

_Tested on Magento 2.2.5._
