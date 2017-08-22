<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-7
 * Time: 下午5:38
 */
namespace Service;
use Core\Auth;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
class AuthProvider  implements ServiceProviderInterface{
    public function register(Container $pimple)
    {
        $pimple['auth'] = function($pimple){
            return Auth::getInstance($pimple->config->get('auth'));
        };
    }
}