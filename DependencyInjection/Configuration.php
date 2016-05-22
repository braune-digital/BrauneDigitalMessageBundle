<?php

namespace BrauneDigital\MessageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('braune_digital_message');

        $this->addEntitiesSection($rootNode);

        return $treeBuilder;
    }

    protected function addEntitiesSection($node) {

        $node->children()->arrayNode('entities')
            ->addDefaultsIfNotSet(true)
            ->children()
            ->scalarNode('conversation')->defaultValue('Application\BrauneDigital\MessageBundle\Entity\Conversation')->end()
            ->scalarNode('message')->defaultValue('Application\BrauneDigital\MessageBundle\Entity\Message')->end()
            ->scalarNode('user_has_message')->defaultValue('Application\BrauneDigital\MessageBundle\Entity\UserHasMessage')->end()
            ->scalarNode('user_has_conversation')->defaultValue('Application\BrauneDigital\MessageBundle\Entity\UserHasConversation')->end();
    }
}
