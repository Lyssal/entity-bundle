<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Appellation;

use Lyssal\Entity\Appellation\AppellationManager as LyssalAppellationManager;
use Lyssal\Entity\Decorator\DecoratorInterface;
use Lyssal\EntityBundle\Entity\RoutableInterface;
use Lyssal\EntityBundle\Router\EntityRouterManager;

/**
 * @inheritDoc
 */
class AppellationManager extends LyssalAppellationManager
{
    /**
     * @var \Lyssal\EntityBundle\Router\EntityRouterManager The entity router manager
     */
    protected $entityRouterManager;


    /**
     * Constructor.
     *
     * @param \Lyssal\EntityBundle\Router\EntityRouterManager $entityRouterManager The entity router manager
     */
    public function __construct(EntityRouterManager $entityRouterManager)
    {
        $this->entityRouterManager = $entityRouterManager;
    }


    /**
     * @inheritDoc
     */
    public function appellationHtml($object)
    {
        $appellation = parent::appellationHtml($object);
        $url = null;

        if ($object instanceof RoutableInterface) {
            $url =  $this->entityRouterManager->generate($object);
        } elseif ($object instanceof DecoratorInterface && $object->getEntity() instanceof RoutableInterface) {
            $url =  $this->entityRouterManager->generate($object->getEntity());
        }

        if (null !== $url) {
            return '<a href="'.$url.'">'.$appellation.'</a>';
        }

        return $appellation;
    }
}
