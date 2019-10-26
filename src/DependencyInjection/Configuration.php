<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @inheritDoc
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treebuilder = new TreeBuilder();
        $rootNode = $treebuilder->root('lyssal_entity');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('breadcrumbs')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('template')
                            ->cannotBeEmpty()
                            ->defaultValue('@LyssalEntity/_breadcrumbs/default.html.twig')
                        ->end()
                        ->scalarNode('root')
                            ->defaultNull()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treebuilder;
    }
}
