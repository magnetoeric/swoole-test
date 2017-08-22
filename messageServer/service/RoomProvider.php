<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-6
 * Time: 下午10:49
 */
namespace Service;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Core\Room;
class RoomProvider implements  ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['room'] = function ($pimple) {
            return Room::getInstance();
        };
    }
}