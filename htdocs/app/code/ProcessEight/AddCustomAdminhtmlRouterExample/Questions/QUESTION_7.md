Tested on Magento 2.2.5.

## Exam

### Question
You need to create a interface as a blueprint for a model that is stored in the database. The file name is TemperaturePointInterface.php 

Where do you place this file?

### Answers

#### app/code/MyCompany/MyModule/Api
INCORRECT: Interfaces which represent Service classes (classes which manipulate models) are located here. Therefore the interface definition of the Data Models themselves are located in the `Api/Data` folder.

#### app/code/MyCompany/MyModule/Api/Data
CORRECT: Interfaces which represent models are stored in the data folder. In Magento, all models using the Service Contract design pattern are, by definition, 'Data Models'. Data Models are merely containers for the loaded data of the model. They should only contain accessors and mutators (get and set methods) and must contain no load/save logic or custom logic of their own.

#### app/code/MyCompany/MyModule/Model
INCORRECT: The `Model` folder contains concrete implementations of Data Model interfaces.

#### app/code/MyCompany/MyModule/Blueprint
INCORRECT: This is the red herring answer. Whilst it is possible to create a folder called 'Blueprint', interfaces for Data Models should be stored in the `Api/Data` folder and in that place only.

## Disclaimer
This module is intended as a learning aid only and is not intended for use in production systems.

## Copyright
&copy; 2019 ProcessEight
