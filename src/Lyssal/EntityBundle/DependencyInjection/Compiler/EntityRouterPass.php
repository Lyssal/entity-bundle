<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * The compiler pass for entity routers.
 */
class EntityRouterPass implements CompilerPassInterface
{
    /**
     * Process tha compiler pass.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container
     */
    public function process(ContainerBuilder $container)
    {
        $services = $container->findTaggedServiceIds('lyssal.entity_router');
        $managerService = $container->getDefinition('lyssal.entity_router');

        foreach (array_keys($services) as $id) {
            $managerService->addMethodCall('addEntityRouterHandler', array(new Reference($id)));
        }
    }
}
