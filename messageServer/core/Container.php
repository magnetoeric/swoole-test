<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-7
 * Time: 下午5:38
 */
namespace Core;
use Service\AuthProvider;
use \Service\ConfigProvider;
use \Service\CacheProvider;
use \Service\RoomProvider;
use \Service\MapperProvider;
class Container extends \Pimple\Container{
    protected $providers = [
        ConfigProvider::class,
        CacheProvider::class,
        RoomProvider::class,
        AuthProvider::class,
        MapperProvider::class
    ];
    public function __construct()
    {
        parent::__construct();
        $this->registerProviders();
    }


    protected function registerProviders(){
        foreach ($this->providers as $provider){
            $this->register(new $provider);
        }
    }

    public function __get($name)
    {
        return $this->offsetGet($name);
    }
    public function __set($name, $value)
    {
        $this->offsetSet($name, $value);
    }
}