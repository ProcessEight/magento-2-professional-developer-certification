## Exam

### Question
What must be done differently to properly generate a URL in the Magento backend?

### Answers

Choose one.

#### Instead of calling the getUrl() method, you must call the getBackendUrl() method.

INCORRECT: 

#### Generate the URL from an instance of \Magento\Backend\Model\UrlInterface.

CORRECT: 

#### Ensure that the controller is configured for the correct ACL path.

INCORRECT:  

#### Nothing: generating URLs in the frontend and backend are the same.

INCORRECT:  

### Further notes

#### Example: Generating a URL in the backend

#### Example: Generating a URL in the frontend

Tested on Magento 2.2.5.

## Copyright
&copy; 2019 ProcessEight
