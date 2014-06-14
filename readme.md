## Testing in PHP Workshop
Testing is wonderful. By having tests you can feel confident in your code, onboard faster, ensure changes don't break other things.

### Overview
This project includes a `Gist` resouce. This includes a controller, a model, some views, and some routes.

### Unit Testing
By definition unit tests cover the smallest unit of code. Code is easy to unit test when it has low dependencies and can either returns something, or has a side effect like manipulating an object.

We have unit tests for the `Gist` model. Some of these tests are failing, some are missing code, and some are completely blank.

### Functional Testing
A step up from unit tests, a Functional test. These types of tests can test multiple layers, or slices, of your application. In practice this usually includes your controller that interacts with a model and database.

### Integration Tests
The next step up is to test the full stack. The benefit here is you can make sure entire features work as expected and interact well with each other.
