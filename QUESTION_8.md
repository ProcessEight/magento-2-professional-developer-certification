Tested on Magento 2.2.5.

## Exam

### Question

You have written the following code for a router:
```php
public function match (\Magento\Framework\App\RequestInterface $request)
{
    if (strpos($request->getPathInfo(), 'test') === false) return;
    $request->setModuleName(‘MyCompany_MyModule’)
       ->setControllerName('test')->setActionName('test');

    return $this->actionFactory->create(
        \Magento\Framework\App\Action\Forward::class, ['request' => $request]
    );
}
```
What is the result of this code being executed when navigating to /test?

### Answers

Choose one.

#### “Front controller reached 100 router match iterations” error.

CORRECT: 

#### A 404 error.

INCORRECT: 

#### Success

INCORRECT:  

#### “Invalid action type specified” error.

INCORRECT:  

### Further notes

## Disclaimer
This module is intended as a learning aid only and is not intended for use in production systems.

## Copyright
&copy; 2019 ProcessEight
