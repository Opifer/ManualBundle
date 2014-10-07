ManualBundle
============

This bundle is still in heavy development. 
It is usable but please note that this bundle will be updated quite a lot.


Installation
------------

First, add the bundle to `composer.json`  

    composer require opifer/manual-bundle dev-master
    
Register the necessary bundles in `app/AppKernel.php`

```php
public function registerBundles()
{    
    $bundles = array(
        ...
        new \Opifer\ManualBundle\OpiferManualBundle(),
        new Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),        
        new \Knp\Bundle\MarkdownBundle\KnpMarkdownBundle(),
        ...
    );
    
    // This bundle will only be loaded on the test envoirement.
    if (in_array($this->getEnvironment(), array('test'))) 
    {
        $bundles[] = new \Liip\FunctionalTestBundle\LiipFunctionalTestBundle();
    }
}
```

Using this bundle
-----------------

For using this bundle, please refer to, [Getting Started](Resources/doc/getting-started.md) in the `Resources/doc` folder 


Testing
-------

This bundle makes use of [Behat](http://docs.behat.org/en/v3.0/) and Mink, [Selenium](http://www.seleniumhq.org/) (for GUI javascript) or [PhamtomJS](http://phantomjs.org/) (for CLI javascript testing if no gui is available) 

We will provide a detailed description on how to let the tests pass later on.