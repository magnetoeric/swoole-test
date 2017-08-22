<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-5-31
 * Time: 下午9:45
 */
namespace Model;
class ResponseStatusModel{
    const RESPONSE_SUCCESS = 100;
    const RESPONSE_FAIL = 200;
    const RESPONSE_NO_AUTH = 401;
    const RESPONSE_BAD_REQUEST = 400;
    const RESPONSE_UNDEFINED = 500;
    private function __construct(){
        
    }
}