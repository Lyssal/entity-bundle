<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Appellation;

use Lyssal\Entity\Decorator\AbstractDecorator;
use Lyssal\EntityBundle\Router\EntityRouterManager;

/**
 * The abstract appellation which use the __toString method by default.
 */
abstract class AbstractDefaultAppellation extends AbstractAppellation
{
    /**
     * @var \Lyssal\EntityBundle\Router\EntityRouterManager The entity router manager
     */
    protected $entityRouterManager;


    /**
     * AbstractDefaultAppellation constructor.
     *
     * @param \Lyssal\EntityBundle\Router\EntityRouterManager $entityRouterManager The entity router manager
     */
    public function __construct(EntityRouterManager $entityRouterManager)
    {
        parent::__construct();
        $this->entityRouterManager = $entityRouterManager;
    }


    /**
     * @see \Lyssal\Entity\Appellation\AppellationInterface::appellation()
     */
    public function appellation($object)
    {
        if ($object instanceof AbstractDecorator && !method_exists($object, '__toString')) {
            return $this->appellation($object->getEntity());
        }

        return (string) $object;
    }

    /**
     * {@inheritDoc}
     */
    public function appellationHtml($object)
    {
        $url =  $this->entityRouterManager->generate($object);

        if (null !== $url) {
            return '<a href="'.$url.'">'.parent::appellationHtml($object).'</a>';
        }

        return parent::appellationHtml($object);
    }
}
