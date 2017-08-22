<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-5
 * Time: 下午10:02
 */
namespace Core;
class Room{
    const ROOM_KEY_PREFIX = 'message:room:';
    const FD_ROOM_MAP = 'fd_room_map';
    private static $instance;
    private $cache;
    private function __construct(){
        $this->cache = CacheFactory::getInstance()->getClient('redis');
    }

    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Room();
        }
        return self::$instance;
    }
    public function join($fd,$group){
        $this->cache->sAdd(self::ROOM_KEY_PREFIX.$group,$fd);
        $this->cache->hSet(self::FD_ROOM_MAP,$fd,$group);
    }

    public function leave($fd){
        $group = $this->cache->hGet(self::FD_ROOM_MAP,$fd);
        $this->cache->sRem(self::ROOM_KEY_PREFIX.$group,$fd);
    }


}