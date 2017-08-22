<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-1
 * Time: 下午10:23
 */
namespace Core;
class Auth{
    const APP_KEY_SUFFIX = "_appKey";
    const RULE_SUFFIX = "_rule";
    
    private static $instance;
    private $authConfig;
    private function __construct($authConfig){
            $this->authConfig = $authConfig;
    }
    public static function getInstance($authConfig){
        if(!isset(self::$instance)){
            self::$instance = new Auth($authConfig);
        }
        return self::$instance;
    }
    public function valid($type,$appKey,$group){
        if(!$group || !$type || !$appKey){
            return false;
        }
        if(($appKey == $this->authConfig[$type.self::APP_KEY_SUFFIX]) &&
            preg_match("/{$this->authConfig[$type.self::RULE_SUFFIX]}/",$group)){
            return true;
        }
        return false;
    }
}