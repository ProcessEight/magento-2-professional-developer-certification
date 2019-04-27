Tested on Magento 2.2.5.

## Exam

### Question
You are troubleshooting an error on a staging website. It is challenging to track down because no error information is being shown to the web browser. 

How can you get better information on the error using native Magento functionality?

### Answers

#### Run bin/magento deploy:mode:set developer to enable developer deploy mode.
CORRECT: Enabling Developer Mode means that Magento will display all errors and throw all exceptions, rather than hiding or logging them.

It is acceptable to enable Developer Mode on this website because it is a staging website, therefore there is no risk of disrupting the clients' business or exposing sensitive or private data by enabling Developer Mode. 

#### In app/etc/di.xml, change the <argument> node for DisplayErrorVerbosity to be true.
INCORRECT: There is no such argument.

#### Change Stores > Configuration > Developer > Logging = Enabled.
INCORRECT: This is the red herring answer. Whilst it is possible to enable/disable logging to file through the admin, the given configuration menu does not exist and the option is called 'Log To File', not 'Logging'. 

Also, logging to file is disabled in Production Mode.

#### Add ”deploy-mode” => true into app/etc/config.php.
INCORRECT: This is another answer which looks like a configuration option, but is actually completely made-up. There is no 'deploy-mode' option and even if there were, wouldn't the value of it be the name of the deployed 'Mode' rather than just a boolean value?

Perhaps this question is trying to fool you into thinking that the (non-existent) 'deploy-mode' setting is set by the (very much existent) `deploy:mode:set` CLI command?

## Disclaimer
This module is intended as a learning aid only and is not intended for use in production systems.

## Copyright
&copy; 2019 ProcessEight
