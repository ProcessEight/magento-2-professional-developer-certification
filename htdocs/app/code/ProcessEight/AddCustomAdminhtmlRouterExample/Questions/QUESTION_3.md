Tested on Magento 2.2.5.

## Exam

### Question
You are setting up an event observer for the sales_order_place_after event. The observer must only take an action after a website visitor places an order. What steps do you take (choose 3)?

### Answers

Choose two.

#### Ensure that etc/events.xml exists.
INCORRECT: @todo Add explanation why

#### Ensure that etc/webapi_rest/events.xml exists.
CORRECT: @todo Add explanation why

#### Create an observer class that implements \Magento\Framework\Event\ObserverInterface
CORRECT: The Observer interface defines the execute method, which Magento will call when it instantiates the Observer class.

#### Create an event and observer node in events.xml that specifies the object instance.
CORRECT: Magento will instantiate the class defined in the `instance` attribute of the `observer` node.

#### Run the bin/magento event:listen sales_order_place_after CLI command.
INCORRECT: This is the red herring answer. There is no such command. There is no need to execute any CLI command to add a new Event Observer. 

### Explanation


## Disclaimer
This module is intended as a learning aid only and is not intended for use in production systems.

## Copyright
&copy; 2019 ProcessEight
