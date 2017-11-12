<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Appellation;

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
        return (string) $object;
    }
}
