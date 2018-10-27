<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Entity;

/**
 * Interface for entities linked to an entity.
 */
interface EntityableInterface
{
    /**
     * Set the entity class name.
     *
     * @param string|null $entityClass The entity class
     */
    public function setEntityClass(?string $entityClass);

    /**
     * Get the entity class name.
     *
     * @return string|null The class
     */
    public function getEntityClass(): ?string;

    /**
     * Set the entity ID.
     *
     * @param int|null $entityId The entity ID
     */
    public function setEntityId(?int $entityId);

    /**
     * Get the entity ID.
     *
     * @return int|null The ID
     */
    public function getEntityId(): ?int;

    /**
     * Set the entity.
     *
     * @param object|null $entity The entity
     */
    public function setEntity($entity);

    /**
     * Get the entity.
     *
     * @return object|null The object
     */
    public function getEntity();
}
