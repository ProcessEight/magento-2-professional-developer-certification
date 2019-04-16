## Exam

### Question
What must be done differently to properly generate a URL in the Magento backend?

### Answers

Choose one.

#### Instead of calling the getUrl() method, you must call the getBackendUrl() method.

INCORRECT: Whilst there is a `getBackendUrl` method, it is defined in the `\Magento\Backend\App\Action\Context` class. Methods in context classes should not be called directly. They should only be called in the constructor of an extending class, to initialise a property of that class.

#### Generate the URL from an instance of \Magento\Backend\Model\UrlInterface.

CORRECT: `\Magento\Backend\Model\UrlInterface` is injected into `\Magento\Backend\App\Action\Context`. Any class which extends that (or injects it) can now access `\Magento\Backend\Model\UrlInterface` via the context object's method `\Magento\Backend\App\Action\Context::getBackendUrl` (`getBackendUrl` just returns the instance of `\Magento\Backend\Model\UrlInterface` injected into `\Magento\Backend\App\Action\Context`).

#### Ensure that the controller is configured for the correct ACL path.

INCORRECT: Controllers do play a part in URL generation, but ACL has nothing to do with generating URLs.

#### Nothing: Generating URLs in the frontend and backend are the same.

INCORRECT: The premise of this answer possibly comes from the fact that the `getUrl` method of `Magento\Backend\Model\UrlInterface` is actually defined in the parent interface, `\Magento\Framework\UrlInterface`. That class _is_ used to generate URLs on the frontend. The answer appears to exploit the confusion which may arise from the inheritance at play here.

### Example from core

#### Generating a URL in the backend
To do

#### Generating a URL in the frontend
To do

### Custom example

To do

### Further notes
- Why is there a specific class for generating backend URLs?

### Points for further investigation

- Are there different ways of generating URLs in the backend, or just the one referred to in the correct answer?
- How is the backend frontname (i.e. `/admin/`) added to backend URLs?
- How does the URL generation process cope with secure URLs (i.e. HTTPS)?
- How can you generate a URL with query parameters?

_Tested on Magento 2.2.5._

## Copyright
&copy; 2019 ProcessEight
