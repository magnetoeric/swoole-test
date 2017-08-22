<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-1
 * Time: 下午9:36
 */
namespace Core;
class Config{
    private static $instance;
    private $config;
    private function __construct(){
        $this->config = parse_ini_file(_CONFIG_FILE_,true);
    }
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Config();
        }
        return  self::$instance;
    }
    public function get($section){
        return $this->config[$section];
    }
}