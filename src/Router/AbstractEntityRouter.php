<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Router;

use Symfony\Component\Routing\RouterInterface;

/**
 * The abstract entity router handler.
 */
abstract class AbstractEntityRouter implements EntityRouterInterface
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface The router
     */
    protected $router;


    /**
     * EntityRouter constructor.
     *
     * @param \Symfony\Component\Routing\RouterInterface $router The router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
}
