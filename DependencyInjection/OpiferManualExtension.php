<?php

namespace Opifer\ManualBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class OpiferManualExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $processedConfig = $this->processConfiguration( $configuration, $configs );

        $parameters = $this->getParameters($processedConfig);
        foreach ($parameters as $key => $value) {
            $container->setParameter($key, $value);
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * Simplifying parameter syntax
     *
     * @param  array $config
     * @return array
     */
    public function getParameters($config)
    {
        return [
            'opifer_manual.bundles' => $config['bundles']
        ];
    }
}
