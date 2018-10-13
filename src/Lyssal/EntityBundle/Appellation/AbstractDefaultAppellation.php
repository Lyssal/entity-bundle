<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Appellation;

use Lyssal\Entity\Decorator\AbstractDecorator;

/**
 * The abstract appellation which use the __toString method by default.
 */
abstract class AbstractDefaultAppellation extends AbstractAppellation
{
    /**
     * @see \Lyssal\Entity\Appellation\AppellationInterface::appelation()
     */
    public function appellation($object)
    {
        if ($object instanceof AbstractDecorator && !method_exists($object, '__toString')) {
            return $this->appellation($object->getEntity());
        }

        return (string) $object;
    }
}
