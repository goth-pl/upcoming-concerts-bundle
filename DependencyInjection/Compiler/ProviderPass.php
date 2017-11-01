<?php

namespace Goth\UpcomingConcertsBundle\DependencyInjection\Compiler;

use Goth\UpcomingConcertsBundle\Renderer\UpcomingConcertsRenderer;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ProviderPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $upcomingConcertsRendererId = 'goth_upcoming_concerts.renderer.upcoming_concerts';

        if (!$container->hasDefinition($upcomingConcertsRendererId)) {
            return;
        }

        $upcomingConcertsRenderer = $container->getDefinition($upcomingConcertsRendererId);

        $taggedServiceIds = $container->findTaggedServiceIds('goth_upcoming_concerts.provider');

        foreach ($taggedServiceIds as $id => $tags) {
            foreach ($tags as $tag) {
                if (!isset($tag['alias'])) {
                    throw new LogicException('goth_upcoming_concerts.provider service tag needs an "alias" attribute to identify the provider. None given.');
                }

                $upcomingConcertsRenderer->addMethodCall(
                    'addProvider',
                    array($tag['alias'], new Reference($id))
                );
            }
        }
    }
}