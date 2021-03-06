<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\EntityBundle\Twig\Extension;

use Lyssal\EntityBundle\Router\EntityRouterManager;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * The twig method to generate an entity URL.
 */
class PathExtension extends AbstractExtension
{
    /**
     * @var \Lyssal\EntityBundle\Router\EntityRouterManager The entity router manager
     */
    protected $entityRouterManager;


    /**
     * PathExtension constructor.
     *
     * @param \Lyssal\EntityBundle\Router\EntityRouterManager $entityRouterManager The entity router manager
     */
    public function __construct(EntityRouterManager $entityRouterManager)
    {
        $this->entityRouterManager = $entityRouterManager;
    }


    /**
     * @inheritDoc
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('entity_path', [$this, 'path']),
        ];
    }


    /**
     * @see \Lyssal\EntityBundle\Router\EntityRouterInterface::generate()
     */
    public function path($routable, $parameters = [], $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): ?string
    {
        return $this->entityRouterManager->generate($routable, $parameters, $referenceType);
    }
}
