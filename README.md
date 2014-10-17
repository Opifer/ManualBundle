ManualBundle
============

This bundle is still in heavy development.
It is usable but please note that this bundle will be updated quite a lot.
It is originally meant to be used with `opifer/cms`, 
but it is possible to use it stand-alone in your own cms system for example.


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
        new \Symfony\Cmf\Bundle\RoutingBundle\CmfRoutingBundle(),        
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

> **NOTE**  
> If you use `opifer/cms` you do not need to do this!
> You do however need to do the following and please make sure you have [bower](http://bower.io) installed
> For the below mentioned steps we assume you have setup a database already and let symfony create it.

Last of all, you need to use the command line to cd into the manual-bundle and do a `bower install`
First, cd into the manual-bundle: 
```bash
    cd vendor/opifer/manual-bundle
```

Then, do:
```bash
    bower install
```
It will install all the things it needs to run!

The last thing you need to do is:
```bash
    app/console opifer:refresh
```
This last command will install the necessary Help markdown files 
which come with the bundle and all other bundles that have the above 
mentioned folder structure. if you haven't setup a help structure for 
your own bundle and you would like to do that, you need to re-run either 
`app/console opifer:refresh` or `app/console opifer:manual:index`.
I suggest you use the first one as it also re-installs the asset files and clears the cache!


Using this bundle
-----------------

For using this bundle, please refer to, [Getting Started](Resources/doc/getting-started.md) in the `Resources/doc` folder

> **NOTE:**
> This bundle is dependent on a template file.
> This bundle uses 2 view files located in `Resources/views/Help.
> Go in those files and change the template file according to where your template file is located. 
> We have it setup as a sensible default.


Testing
-------

This bundle makes use of [Behat](http://docs.behat.org/en/v3.0/) and [Mink](http://mink.behat.org), 
[Selenium](http://www.seleniumhq.org/) (for GUI javascript) or [PhamtomJS](http://phantomjs.org/) (for CLI javascript testing if no gui is available) 

We will provide a detailed description on how to let the tests pass later on.
