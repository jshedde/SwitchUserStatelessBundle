<?php

namespace SwitchUserStatelessBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder->root('switch_user_stateless')
            ->children()
            ->scalarNode('user_class')->isRequired()->end();

        return $treeBuilder;
    }
}
