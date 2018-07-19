<?php
declare(strict_types=1);

/**
 * GpsLab component.
 *
 * @author    Peter Gribanov <info@peter-gribanov.ru>
 * @copyright Copyright (c) 2017, Peter Gribanov
 * @license   http://opensource.org/licenses/MIT
 */

namespace GpsLab\Bundle\GeoIP2Bundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Config tree builder.
     *
     * Example config:
     *
     * gpslab_geoip:
     *     cache: '%kernel.cache_dir%/GeoLite2-City.mmdb'
     *     url: 'http://geolite.maxmind.com/download/geoip/database/GeoLite2-City.mmdb.gz'
     *     locales: [ '%locale%' ]
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $tree = new TreeBuilder();
        $tree
            ->root('gpslab_geoip')
                ->children()
                    ->scalarNode('cache')
                        ->cannotBeEmpty()
                        ->defaultValue('%kernel.cache_dir%/GeoLite2-City.mmdb')
                    ->end()
                    ->scalarNode('url')
                        ->cannotBeEmpty()
                        ->defaultValue('http://geolite.maxmind.com/download/geoip/database/GeoLite2-City.mmdb.gz')
                    ->end()
                    ->arrayNode('locales')
                        ->treatNullLike([])
                        ->prototype('scalar')->end()
                        ->defaultValue(['%locale%'])
                    ->end()
                ->end()
            ->end()
        ;

        return $tree;
    }
}
