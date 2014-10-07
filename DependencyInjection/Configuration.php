<?php

namespace Opifer\ManualBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     * @see http://symfony.com/doc/current/components/config/definition.html
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $rootNode = $builder->root('opifer_manual');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('bundles')
                    ->treatNullLike(array())
                    ->prototype('scalar')->end()
                    ->defaultValue(['OpiferCmsBundle', 'OpiferManualBundle'])
                ->end()
            ->end()
        ;

        return $builder;
    }
}
