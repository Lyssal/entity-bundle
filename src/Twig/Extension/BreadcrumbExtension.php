<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Twig\Extension;

use Lyssal\EntityBundle\Breadcrumb\BreadcrumbGenerator;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * The twig method to generate a breadcrumb.
 */
class BreadcrumbExtension extends AbstractExtension
{
    /**
     * The templating service.
     *
     * @var \Twig\Environment
     */
    protected $templating;

    /**
     * The breadcrumb generator.
     *
     * @var \Lyssal\EntityBundle\Breadcrumb\BreadcrumbGenerator
     */
    protected $breadcrumbGenerator;

    /**
     * The breadcrumb template.
     *
     * @var string
     */
    private $template;


    /**
     * BreadcrumbExtension constructor.
     *
     * @param \Lyssal\EntityBundle\Breadcrumb\BreadcrumbGenerator $breadcrumbGenerator The breadcrumb generator
     */
    public function __construct(Environment $templating, BreadcrumbGenerator $breadcrumbGenerator, string $breadcrumbTemplate)
    {
        $this->templating = $templating;
        $this->breadcrumbGenerator = $breadcrumbGenerator;
        $this->template = $breadcrumbTemplate;
    }


    /**
     * @inheritDoc
     */
    public function getFunctions()
    {
        return[
            new TwigFunction('lyssal_breadcrumb', [$this, 'breadcrumb'], ['is_safe' => ['html']])
        ];
    }


    /**
     * @see \Lyssal\EntityBundle\Breadcrumb\BreadcrumbGenerator::generate()
     *
     * @return string The breadcrumb template
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function breadcrumb(...$items): string
    {
        return $this->templating->render($this->template, [
            'breadcrumbs' => $this->breadcrumbGenerator->generate($items),
        ]);
    }
}
