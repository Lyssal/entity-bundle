<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Breadcrumb;

use Lyssal\Entity\Appellation\AppellationManager;
use Lyssal\Entity\Decorator\DecoratorInterface;
use Lyssal\Entity\Model\Breadcrumb\Breadcrumb;
use Lyssal\Entity\Model\Breadcrumb\BreadcrumbableInterface;
use Lyssal\EntityBundle\Router\EntityRouterManager;

/**
 * Generate a breadcrumb with Parentable and ManyParentable interfaces.
 */
class BreadcrumbGenerator
{
    /**
     * @var \Lyssal\Entity\Appellation\AppellationManager The appellation manager
     */
    protected $appellationManager;

    /**
     * @var \Lyssal\EntityBundle\Router\EntityRouterManager The entity router
     */
    protected $entityRouterManager;


    /**
     * BreadcrumbGenerator constructor.
     *
     * @param \Lyssal\Entity\Appellation\AppellationManager   $appellationManager  The appellation manager
     * @param \Lyssal\EntityBundle\Router\EntityRouterManager $entityRouterManager The entity router
     */
    public function __construct(AppellationManager $appellationManager, EntityRouterManager $entityRouterManager)
    {
        $this->appellationManager = $appellationManager;
        $this->entityRouterManager = $entityRouterManager;
    }


    /**
     * Get the breadcrumb array.
     *
     * @param mixed               $entity         The entity
     * @param array<mixed>|string $breadcrumbRoot The first elements of the breadcrumbs
     * @param array<mixed>        $breadcrumb     (optional) The breadcrumb
     *
     * @return array<mixed> The breadcrumb
     */
    public function generate($entity, $breadcrumbRoot = [], array $breadcrumbs = []): array
    {
        if (null !== $entity) {
            array_unshift($breadcrumbs, $this->formatBreadcrumb($entity));

            if ($entity instanceof BreadcrumbableInterface) {
                $breadcrumbParent = $entity->getBreadcrumbParent();
                if (null !== $breadcrumbParent) {
                    return $this->generate($breadcrumbParent, $breadcrumbRoot, $breadcrumbs);
                }
            }
            if (
                $entity instanceof DecoratorInterface
                && $entity->getEntity() instanceof BreadcrumbableInterface
            ) {
                $breadcrumbParent = $entity->getEntity()->getBreadcrumbParent();
                if (null !== $breadcrumbParent) {
                    return $this->generate($breadcrumbParent, $breadcrumbRoot, $breadcrumbs);
                }
                return $this->generate($entity->getEntity()->getBreadcrumbParent(), $breadcrumbRoot, $breadcrumbs);
            }
        }

        return $this->addRoot($breadcrumbs, $breadcrumbRoot);
    }

    /**
     * Add the first elements in breadcrumbs.
     *
     * @param array<mixed>        $breadcrumbs     The breadcrumbs
     * @param array<mixed>|string $rootBreadcrumbs The first elements of the breadcrumbs
     */
    protected function addRoot(array $breadcrumbs, $rootBreadcrumbs = []): array
    {
        if (!is_array($rootBreadcrumbs)) {
            $formattedRoots = [$this->formatBreadcrumb($rootBreadcrumbs)];
        } else {
            $formattedRoots = [];
            foreach ($rootBreadcrumbs as $breadcrumb) {
                $formattedRoots[] = $this->formatBreadcrumb($breadcrumb);
            }
        }

        return array_merge($formattedRoots, $breadcrumbs);
    }

    /**
     * Format the breadcrumb element.
     *
     * @param mixed $breadcrumb The breadcrumb element
     *
     * @return \Lyssal\Entity\Model\Breadcrumb\Breadcrumb The formatted breadcrumb
     */
    protected function formatBreadcrumb($breadcrumb): Breadcrumb
    {
        $breadcrumbModel = new Breadcrumb();

        if (is_object($breadcrumb)) {
            $breadcrumbModel->setLabel($this->appellationManager->appellation($breadcrumb));
        } else {
            $breadcrumbModel->setLabel((string) $breadcrumb);
        }

        $breadcrumbModel->setLink($this->entityRouterManager->generate($breadcrumb));

        return $breadcrumbModel;
    }
}
