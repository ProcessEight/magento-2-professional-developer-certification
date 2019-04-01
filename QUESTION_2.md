## Exam

### Question
When writing a model triad (model, resource model, collection), what is the correct way to save a model to the database?

### Answers

Choose one.

#### Call the save method in the collection class.

INCORRECT: This just calls the model `save` method on every model in the collection. This approach has been deprecated. Entities _must not_ be responsible for their own persistence. Service contracts should persist entities. Use resource model `save` to implement service contract persistence operations.

#### Call the save method in the resource model class.

CORRECT: Resource models are the only models which should interact with the database. A model should be passed to `save` method of the resource model to be saved.

#### Call the save method in the repository.

INCORRECT: Repositories are not part of the 'model triad'. Technically speaking, repositories should be used to save entities where possible (especially when communicating across module boundaries). However, 'repository' is not part of the 'model triad', so in the context of the question, this answer is a red herring.

#### Call the save method in the model class.

INCORRECT: This approach has been deprecated. Entities _must not_ be responsible for their own persistence. Service contracts should persist entities. Use resource model `save` to implement service contract persistence operations.

### Further notes

Tested on Magento 2.2.5.
