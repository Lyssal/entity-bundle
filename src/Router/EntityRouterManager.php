<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Router;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Traversable;

/**
 * The entity router manager.
 */
class EntityRouterManager
{
    /**
     * @var \Lyssal\EntityBundle\Router\EntityRouterInterface[] The entity routers
     */
    protected $entityRouters = [];


    /**
     * Add entity routers.
     *
     * @param \Lyssal\EntityBundle\Router\EntityRouterInterface[] $entityRouters The entity routers
     */
    public function addEntityRouters(Traversable $entityRouters): void
    {
        foreach ($entityRouters as $entityRouter) {
            $this->addEntityRouter($entityRouter);
        }
    }

    /**
     * Add an entity router.
     *
     * @param \Lyssal\EntityBundle\Router\EntityRouterInterface $entityRouter The entity router
     */
    public function addEntityRouter(EntityRouterInterface $entityRouter): void
    {
        $this->entityRouters[] = $entityRouter;
    }

    /**
     * @see \Lyssal\EntityBundle\Router\EntityRouterInterface::generate()
     */
    public function generate($entity, $parameters = [], $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): ?string
    {
        foreach ($this->entityRouters as $entityRouter) {
            $url = $entityRouter->generate($entity, $parameters, $referenceType);
            if (null !== $url) {
                return $url;
            }
        }

        return null;
    }
}
