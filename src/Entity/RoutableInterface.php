<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Entity;

/**
 * The routable interface.
 */
interface RoutableInterface
{
    /**
     * Get the route properties (route name and parameters).
     *
     * @return array|string The route properties (or only name if any parameters)
     */
    public function getRouteProperties();
}
