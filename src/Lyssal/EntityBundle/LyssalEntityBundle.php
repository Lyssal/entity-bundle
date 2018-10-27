<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle;

use Lyssal\EntityBundle\DependencyInjection\Compiler\AppellationPass;
use Lyssal\EntityBundle\DependencyInjection\Compiler\DecoratorPass;
use Lyssal\EntityBundle\DependencyInjection\Compiler\EntityRouterPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * {@inheritDoc}
 */
class LyssalEntityBundle extends Bundle
{
    /**
     * {@inheritDoc}
     *
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container A ContainerBuilder instance
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container
            ->addCompilerPass(new DecoratorPass())
            ->addCompilerPass(new AppellationPass())
            ->addCompilerPass(new EntityRouterPass())
        ;
    }
}
