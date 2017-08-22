<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-6
 * Time: 上午11:29
 */
namespace Service;
use Core\CacheFactory;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
class CacheProvider implements ServiceProviderInterface{
    public function register(Container $pimple)
    {
        $pimple['cache'] = function ($pimple) {
            return CacheFactory::getInstance()->getClient('redis');
        };
    }
}