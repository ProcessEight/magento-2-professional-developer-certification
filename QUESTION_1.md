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

### Further notes

All the default frontend `page_layout`s (`frontend/page_layout/1column.xml`,`frontend/page_layout/2columns-left.xml`, `frontend/page_layout/2columns-right.xml`, `frontend/page_layout/3columns.xml`) use the `update` Layout XML instruction to 'include' the base `page_layout` in `base/page_layout/empty.xml`. It is `empty.xml` which contains the single reference to the `columns` container.

The adminhtml `page_layout`s do not use the `base/page_layout/empty.xml` file at all.

_Tested on Magento 2.2.5._
