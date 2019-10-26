<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Breadcrumb;

use Lyssal\Entity\Decorator\DecoratorInterface;
use Lyssal\Entity\Model\Breadcrumb\Breadcrumb;
use Lyssal\Entity\Model\Breadcrumb\BreadcrumbableInterface;
use Lyssal\EntityBundle\Appellation\AppellationManager;
use Lyssal\EntityBundle\Router\EntityRouterManager;

/**
 * Generate a breadcrumb with Parentable and ManyParentable interfaces.
 */
class BreadcrumbGenerator
{
    /**
     * @var \Lyssal\EntityBundle\Appellation\AppellationManager The appellation manager
     */
    protected $appellationManager;

    /**
     * @var \Lyssal\EntityBundle\Router\EntityRouterManager The entity router
     */
    protected $entityRouterManager;

    /**
     * @var string|null The root element
     */
    protected $root;


    /**
     * BreadcrumbGenerator constructor.
     *
     * @param \Lyssal\EntityBundle\Appellation\AppellationManager $appellationManager  The appellation manager
     * @param \Lyssal\EntityBundle\Router\EntityRouterManager     $entityRouterManager The entity router
     */
    public function __construct(AppellationManager $appellationManager, EntityRouterManager $entityRouterManager, ?string $breadcrumbRoot)
    {
        $this->appellationManager = $appellationManager;
        $this->entityRouterManager = $entityRouterManager;
        $this->root = $breadcrumbRoot;
    }


    /**
     * Generate the breadcrumb array.
     *
     * @param mixed ...$items The breadcrumb items
     * @return array The breadcrumb
     */
    public function generate(...$items): array
    {
        $items[] = $this->root;
        $breadcrumbs = [];

        foreach ($items as $item) {
            $breadcrumbs = array_merge($breadcrumbs, $this->getBreadcrumbPart($item));
        }

        return array_reverse($breadcrumbs);
    }

    /**
     * Generate a part of the breadcrumb.
     *
     * @param mixed $item The breadcrumb item
     * @return array The breadcrumb part
     */
    protected function getBreadcrumbPart($item): array
    {
        if (null === $item) {
            return [];
        }

        $breadcrumbs = [];

        if (is_array($item) || \is_iterable($item)) {
            foreach ($item as $subItem) {
                $breadcrumbs = array_merge($breadcrumbs, $this->getBreadcrumbPart($subItem));
            }

            return $breadcrumbs;
        }

        if ($item instanceof DecoratorInterface && !$item instanceof  BreadcrumbableInterface) {
            $item = $item->getEntity();
        }

        $breadcrumbs[] = $this->formatBreadcrumb($item);

        if ($item instanceof BreadcrumbableInterface) {
            $breadcrumbs = array_merge($breadcrumbs, $this->getBreadcrumbPart($item->getBreadcrumbParent()));
        }

        return $breadcrumbs;
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
