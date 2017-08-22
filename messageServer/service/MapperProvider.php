<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-7
 * Time: 下午9:36
 */
namespace Service;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
class MapperProvider  implements ServiceProviderInterface{
    public function register(Container $pimple)
    {
        $pimple['mapper'] = function($pimple){
                return new \JsonMapper();
            };
    }
}