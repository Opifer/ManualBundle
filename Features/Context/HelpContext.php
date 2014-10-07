<?php

namespace Opifer\ManualBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Symfony\Component\HttpKernel\KernelInterface;

class HelpContext extends MinkContext implements KernelAwareContext, Context, SnippetAcceptingContext
{
    protected $kernel;

    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @Given /^I am authenticated as "([^"]*)" using "([^"]*)"$/
     */
    public function iAmAuthenticatedAs($username, $password) {
        $this->visit('/admin/login');
        $this->fillField('username', $username);
        $this->fillField('password', $password);
        $this->pressButton('_submit');
    }

    /**
     * @When /^I index the articles$/
     */
    public function iIndexTheArticles()
    {
        // Index the articles in the database
        $this->kernel->getContainer()->get('opifer.manual.help_manager')->indexArticles();
    }
} 