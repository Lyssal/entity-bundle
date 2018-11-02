<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Twig\Extension;

use Lyssal\EntityBundle\Breadcrumb\BreadcrumbGenerator;
use Twig_Extension;
use Twig_SimpleFunction;

/**
 * The twig method to generate a breadcrumb.
 */
class BreadcrumbExtension extends Twig_Extension
{
    /**
     * @var \Lyssal\EntityBundle\Breadcrumb\BreadcrumbGenerator The breadcrumb generator
     */
    protected $breadcrumbGenerator;


    /**
     * BreadcrumbExtension constructor.
     *
     * @param \Lyssal\EntityBundle\Breadcrumb\BreadcrumbGenerator $breadcrumbGenerator The breadcrumb generator
     */
    public function __construct(BreadcrumbGenerator $breadcrumbGenerator)
    {
        $this->breadcrumbGenerator = $breadcrumbGenerator;
    }


    /**
     * @inheritDoc
     */
    public function getFunctions()
    {
        return[
            new Twig_SimpleFunction('lyssal_breadcrumbs', [$this, 'breadcrumbs'])
        ];
    }


    /**
     * @see \Lyssal\EntityBundle\Breadcrumb\BreadcrumbGenerator::generate()
     */
    public function breadcrumbs($entity, $breadcrumbRoot = []): array
    {
        return $this->breadcrumbGenerator->generate($entity, $breadcrumbRoot);
    }
}
