<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Appellation;

use Lyssal\Entity\Appellation\AbstractAppellation as BaseAbstractAppellation;
use Symfony\Component\Routing\RouterInterface;

/**
 * The abstract appellation handler
 */
abstract class AbstractAppellation extends BaseAbstractAppellation
{
    /**
     * @var \Symfony\Component\Routing\RouterInterface $router The router
     */
    protected $router;


    /**
     * Constructor.
     *
     * @param \Symfony\Component\Routing\RouterInterface $router The router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }
}
