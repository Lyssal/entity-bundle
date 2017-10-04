<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Twig\Extension;

use Lyssal\Entity\Decorator\DecoratorManager;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * The Twig methods for the appellation service.
 */
class DecoratorExtension extends Twig_Extension
{
    /**
     * @var \Lyssal\Entity\Decorator\DecoratorManager The decorator manager
     */
    protected $decoratorManager;


    /**
     * Constructor.
     *
     * @param \Lyssal\Entity\Decorator\DecoratorManager $decoratorManager The decorator manager
     */
    public function __construct(DecoratorManager $decoratorManager)
    {
        $this->decoratorManager = $decoratorManager;
    }


    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('decorator', array($this, 'decorator'))
        );
    }

    /**
     * Get the decorator of the object.
     *
     * @param object $object The object
     * @return string The decorator of the object
     * @throws \Lyssal\Entity\Decorator\Exception\DecoratorException If the decorator can not be found
     */
    public function decorator($object)
    {
        return $this->decoratorManager->get($object);
    }


    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'lyssal.entity.twig.extension.decorator';
    }
}
