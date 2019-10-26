<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Router;

/**
 * The interface for the entity router handler.
 */
interface EntityRouterInterface
{
    /**
     * Generate the entity URL.
     *
     * @param object $entity        The routable entity
     * @param array  $parameters    The added route parameters
     * @param int    $referenceType The URL type
     *
     * @return string|null The URL
     */
    public function generate($entity, $parameters, $referenceType) : ?string;
}
