<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-1
 * Time: 下午9:21
 */
namespace Core;
class CacheFactory{
    private static $instance;
    private $cacheClients = array();
    private $map = array(
        'redis' =>RedisClient::class
    );
    private function __construct(){

    }
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new CacheFactory();
        }
        return  self::$instance;
    }
    public  function getClient($client_name){
        $client_name = strtolower(trim($client_name));
        if(!$this->map[$client_name]){
            throw new \Exception('no Cache Client Found!');
        }
        if(!isset($this->cacheClients[$client_name])){
            $this->cacheClients[$client_name] = new $this->map[$client_name](Config::getInstance()->get($client_name));

        }
        return $this->cacheClients[$client_name];

    }
}