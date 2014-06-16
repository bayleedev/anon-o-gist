## Testing in PHP Workshop
Testing is wonderful. By having tests you can feel confident in your code, onboard faster, ensure changes don't break other things.

### Overview
This project includes a `Gist` resouce. This includes a controller, a model, some views, and some routes.

Use [this guide](http://jenssegers.be/blog/49/installing-the-php-mcrypt-extension-on-osx-10-9-mavericks) for help on installing mcrypt.

#### Mcrypt setup when using brew and system php54:
~~~
brew update
brew tap homebrew/homebrew-php
brew install php54-mcrypt
sudo mkdir -p /Library/Server/Web/Config/php
sudo cp /usr/local/etc/php/5.4/conf.d/ext-mcrypt.ini /Library/Server/Web/Config/php
~~~

Test By running `php --ini`.

#### Common Paths
Routes: `app/routes.php`
Controllers: `app/controllers/*Controller.php`
Models: `app/models/*.php`
Unit Tests: `app/tests/models/*Test.php`
Integration Tests: `app/tests/acceptance/features/*.feature`

### Unit Testing
By definition unit tests cover the smallest unit of code. Code is easy to unit test when it has low dependencies and can either returns something, or has a side effect like manipulating an object.

We have unit tests for the `Gist` model. Some of these tests are failing, some are missing code, and some are completely blank.

### Integration Tests
The next step up is to test the full stack. The benefit here is you can make sure entire features work as expected and interact well with each other.

Similar to the unit tests, we have broken tests, testing that are missing steps, and incomplete tests.

### New Features
Implement some of these new features using Unit Tests and Integration tests!
* Don’t show gists that have been flagged 5 or more times.
* Add ability to delete gists with a password.
* Have permalinks (`/gists/MjMyMw==`) vs ids (`/gists/2323`)
* Add to travis. (continual integration!)
