<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Twig\Extension;

use Lyssal\EntityBundle\Appellation\AppellationManager;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * The Twig methods for the appellation service.
 */
class AppellationExtension extends Twig_Extension
{
    /**
     * @var \Lyssal\EntityBundle\Appellation\AppellationManager The appellation manager
     */
    protected $appellationManager;


    /**
     * Constructor.
     *
     * @param \Lyssal\EntityBundle\Appellation\AppellationManager $appellationManager The appellation manager
     */
    public function __construct(AppellationManager $appellationManager)
    {
        $this->appellationManager = $appellationManager;
    }


    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('appellation', array($this, 'appellation'), array('is_safe' => array('html'))),
            new Twig_SimpleFunction('appellation_html', array($this, 'appellationHtml'), array('is_safe' => array('html')))
        );
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
