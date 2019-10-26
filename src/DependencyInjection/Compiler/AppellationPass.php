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
 * The compiler pass for appelations.
 */
class AppellationPass implements CompilerPassInterface
{
    /**
     * Process the compiler pass.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container
     */
    public function process(ContainerBuilder $container)
    {
        $services = $container->findTaggedServiceIds('lyssal.appellation');
        $managerService = $container->getDefinition('lyssal.appellation');

        foreach (array_keys($services) as $id) {
            $managerService->addMethodCall('addAppellationHandler', array(new Reference($id)));
        }
    }
}
