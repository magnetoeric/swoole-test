<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-6
 * Time: 上午11:35
 */
namespace Service;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Core\Config;
class ConfigProvider implements ServiceProviderInterface{
    public function register(Container $pimple)
    {
        $pimple['config'] = function ($pimple) {
            return Config::getInstance();
        };
    }
}