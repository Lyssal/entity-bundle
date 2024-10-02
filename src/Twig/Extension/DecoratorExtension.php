<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Twig\Extension;

use Lyssal\Entity\Decorator\DecoratorManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * The Twig methods for the appellation service.
 */
class DecoratorExtension extends AbstractExtension
{
    public function __construct(protected readonly DecoratorManager $decoratorManager)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('decorator', [$this, 'decorator']),
        ];
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
