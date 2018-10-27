<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Entity;

/**
 * The controllerable interface.
 */
interface ControllerableInterface
{
    /**
     * Get the controller action properties.
     *
     * @return array|string The action properties (or only name if any parameters)
     */
    public function getControllerProperties();
}
