<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Lyssal\Exception\InvalidArgumentException;

/**
 * Add property to retrieve an entity.
 */
trait EntityTrait
{
    /**
     * @var string The entity class name
     *
     * @ORM\Column(type="string", length=768, nullable=true)
     */
    protected $entityClass;

    /**
     * @var int The entity ID
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $entityId;

    /**
     * @var object|null The entity
     */
    protected $entity;


    /**
     * @see \Lyssal\EntityBundle\Entity\EntityableInterface::setEntityClass()
     */
    public function setEntityClass(?string $entityClass)
    {
        $this->entityClass = $entityClass;

        return $this;
    }

    /**
     * @see \Lyssal\EntityBundle\Entity\EntityableInterface::getEntityClass()
     */
    public function getEntityClass(): ?string
    {
        return $this->entityClass;
    }

    /**
     * @see \Lyssal\EntityBundle\Entity\EntityableInterface::setEntityId()
     */
    public function setEntityId(?int $entityId)
    {
        $this->entityId = $entityId;

        return $this;
    }

    /**
     * @see \Lyssal\EntityBundle\Entity\EntityableInterface::getEntityId()
     */
    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    /**
     * @see \Lyssal\EntityBundle\Entity\EntityableInterface::setEntity()
     */
    public function setEntity($entity)
    {
        if (null !== $entity && !is_object($entity)) {
            throw new InvalidArgumentException('The setEntity() parameter must be a valid entity or null.');
        }

        $this->entity = $entity;

        if (null === $this->entity) {
            $this->setEntityClass(null);
            $this->setEntityId(null);
        } elseif (method_exists($this->entity, 'getId')) {
            $this->setEntityClass(get_class($this->entity));
            $this->setEntityId($this->entity->getId());
        } elseif (array_key_exists('id', (array) $entity)) {
            $this->setEntityClass(get_class($this->entity));
            $this->setEntityId($this->entity->id);
        }

        return $this;
    }

    /**
     * @see \Lyssal\EntityBundle\Entity\EntityableInterface::getEntity()
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
