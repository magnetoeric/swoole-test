<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-5-31
 * Time: 上午10:30
 */
use Core\Container;
use Core\SwooleServer;
require "common.php";
$container = new Container();
$server = new SwooleServer($container);
$server->start();
