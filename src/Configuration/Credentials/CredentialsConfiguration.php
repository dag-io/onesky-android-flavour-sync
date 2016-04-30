<?php
namespace DAG\OneSky\Configuration\Credentials;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class CredentialsConfiguration
 */
final class CredentialsConfiguration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('credentials');

        $rootNode
            ->children()
                ->scalarNode('api_key')
                ->end()
                ->scalarNode('api_secret')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
