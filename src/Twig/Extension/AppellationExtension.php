<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Twig\Extension;

use Lyssal\EntityBundle\Appellation\AppellationManager;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * The Twig methods for the appellation service.
 */
class AppellationExtension extends AbstractExtension
{
    public function __construct(protected readonly AppellationManager $appellationManager)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('appellation', [$this, 'appellation'], ['is_safe' => ['html']]),
            new TwigFunction('appellation_html', [$this, 'appellationHtml'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Get the appellation of the object.
     *
     * @param object $object The objet
     * @return string The object appellation
     * @throws \Lyssal\Entity\Appellation\Exception\AppellationException If the appellation can not be found
     */
    public function appellation($object)
    {
        return $this->appellationManager->appellation($object);
    }

    /**
     * Get the HTML appellation of the object.
     *
     * @param object $object The objet
     * @return string The object HTML appellation
     * @throws \Lyssal\Entity\Appellation\Exception\AppellationException If the appellation can not be found
     */
    public function appellationHtml($object)
    {
        return $this->appellationManager->appellationHtml($object);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'lyssal.entity.twig.extension.appellation';
    }
}
