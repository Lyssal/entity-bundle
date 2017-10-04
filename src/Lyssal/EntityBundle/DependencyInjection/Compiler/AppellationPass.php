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
     * Process tha compiler pass.
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container The container
     */
    public function process(ContainerBuilder $container)
    {
        $appellationServices = $container->findTaggedServiceIds('lyssal.appellation');
        $appellationManagerService = $container->getDefinition('lyssal.appellation');

        foreach (array_keys($appellationServices) as $id) {
            $appellationManagerService->addMethodCall('addAppellationHandler', array(new Reference($id)));
        }
    }
}
