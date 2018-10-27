<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Router;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * The entity router manager.
 */
class EntityRouterManager
{
    /**
     * @var \Lyssal\EntityBundle\Router\EntityRouterInterface[] The entity router handlers
     */
    protected $entityRouterHandlers = [];


    /**
     * Add an entity router handler.
     *
     * @param \Lyssal\EntityBundle\Router\EntityRouterInterface $entityRouterHandler The entity router handler
     */
    public function addEntityRouterHandler(EntityRouterInterface $entityRouterHandler): void
    {
        $this->entityRouterHandlers[] = $entityRouterHandler;
    }

    /**
     * @see \Lyssal\EntityBundle\Router\EntityRouterInterface::generate()
     */
    public function generate($entity, $parameters = [], $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): ?string
    {
        foreach ($this->entityRouterHandlers as $entityRouterHandler) {
            $url = $entityRouterHandler->generate($entity, $parameters, $referenceType);
            if (null !== $url) {
                return $url;
            }
        }

        return null;
    }
}
