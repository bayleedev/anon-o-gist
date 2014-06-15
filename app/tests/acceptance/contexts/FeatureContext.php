<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

require_once 'vendor/autoload.php';
require_once 'vendor/phpunit/phpunit/src/Framework/Assert/Functions.php';

class FeatureContext extends BaseContext
{

    /**
     * @Given /^I am on the homepage$/
     */
    public function iAmOnTheHomepage()
    {
        $this->visit('/');
    }

    /**
     * @Given /^I have "([^"]*)" gists$/
     */
    public function iHaveGists($count)
    {
        for ($i = 0;$i<$count;$i++) {
            $this->iHaveAGist();
        }
        if (Gist::count() != $count) {
            throw new Exception('Did not create all gists');
        }
    }

    /**
     * @Then /^I should see (\d+) gists$/
     */
    public function iShouldSeeGists($count)
    {
        $page = $this->session()->getPage();
        if (count($page->findAll('css', 'ul.gists li a')) != $count) {
            throw new Exception('Did not find ' . $count . ' gists');
        }
    }

    /**
     * @When /^I create a gist$/
     */
    public function iCreateAGist()
    {
        $page = $this->session()->getPage();

        $name = $page->find('css', 'input[name=name]');
        $name->setValue('some name');

        $body = $page->find('css', 'textarea[name=body]');
        $body->setValue('Lorem ipsum dolor sit amet, eius libris vel ad, eu nobis scaevola accusata qui.');

        $password = $page->find('css', 'input[type=password]');
        $password->setValue('foobar');

        $submit = $page->find('css', 'input[type=submit]');
        $submit->press();
    }

    /**
     * @Then /^I should be on the gist page$/
     */
    public function iShouldBeOnTheGistPage()
    {
        $url = $this->session()->getCurrentUrl();
        if (!preg_match('/gist\/[0-9]+/', $url)) {
            throw new Exception('You are not on a gist page');
        }
    }

    /**
     * @Given /^I have a gist$/
     */
    public function iHaveAGist()
    {
        $this->gist = $gist = Gist::create(array(
            'name' => 'lorem ipsum',
            'body' => 'Lorem ipsum dolor sit amet, eius libris vel ad, eu nobis scaevola accusata qui.',
            'password' => 'foobar',
        ));
        $gist->save();
    }

    /**
     * @Given /^I am on that gist page$/
     */
    public function iAmOnThatGistPage()
    {
        $this->visit('/gist/' . $this->gist->id);
    }

    /**
     * @Then /^I should see that gist$/
     */
    public function iShouldSeeThatGist()
    {
        $page = $this->session()->getPage();

        $body = $page->find('css', 'textarea[name=body]')->getValue();

        if ($body !== Gist::find($this->gist->id)->body) {
            throw new Exception('Bodys do not match');
        }
    }

    /**
     * @When /^I update the gist$/
     */
    public function iUpdateTheGist()
    {
        $page = $this->session()->getPage();

        $body = $page->find('css', 'textarea[name=body]');
        $body->setValue($body->getValue() . ' annnnd?');

        $password = $page->find('css', 'input[type=password]');
        $password->setValue('foobar');

        $submit = $page->find('css', 'input[type=submit]');
        $submit->press();
    }

    public function __construct(array $parameters) {

        $filesToSkip = ['FeatureContext.php', 'BaseContext.php'];

        $path = dirname(__FILE__);
        $it = new RecursiveDirectoryIterator($path);

        foreach ($it as $file)
        {
            if (preg_match('/swp/', $file)) {
                continue;
            }
            if (! $file->isDir()) {
               $name = $file->getFilename();

                if (in_array($name, $filesToSkip))
                    continue;

                $class = pathinfo($name, PATHINFO_FILENAME);
                require_once $path.'/'.$name;
                $this->useContext($class, new $class($parameters));
            }
        }
    }

    protected function session()
    {
        if ($this->session) {
            return $this->session;
        }
        $driver = new \Behat\Mink\Driver\GoutteDriver();

        $selector = new \Behat\Mink\Selector\CssSelector();
        $handler  = new \Behat\Mink\Selector\SelectorsHandler(array(
            'css' => $selector
        ));

        $session = new \Behat\Mink\Session($driver, $handler);
        $session->setRequestHeader('Accept', 'text/html');
        $session->setRequestHeader('Accept-env', 'test');
        $session->start();
        return $this->session = $session;
    }

    protected function visit($url)
    {
        return $this->session()->visit(Config::get('app.url') . $url);
    }

    public function __destruct()
    {
        foreach (Gist::all() as $gist) {
            $gist->delete();
        }
        $this->session()->reset();
    }

}