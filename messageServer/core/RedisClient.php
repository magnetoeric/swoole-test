<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-1
 * Time: 下午9:29
 */
namespace Core;
use \Redis;
class RedisClient{
    private $client;
    public function __construct($config)
    {
        var_dump('init');
        $this->client = new Redis();
        $this->client->pconnect($config['host'],$config['port']);
    }

    public function get($key)
    {
        return $this->client->get($key);
    }
    public function set($key,$value,$expire='86400')
    {
        return $this->client->set($key,$value,$expire);
    }
    public function __call($name, $arguments)
    {
        if(method_exists('\Redis',$name)){
            return call_user_func_array(array($this->client, $name), $arguments);
        }else{
            throw new \Exception();
        }
    }
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        $this->client->close();
    }
}