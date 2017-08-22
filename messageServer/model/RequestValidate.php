<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-5
 * Time: 下午10:20
 */
namespace Model;
class RequestValidate{
    /**
     * @var bool
     */
    public $valid;
    /**
     * @var int
     */
    public $status;
    /**
     * @var string
     */
    public $msg;
    private function __construct($valid,$status,$msg){
        $this->valid = $valid;
        $this->status = $status;
        $this->msg = $msg;
    }
    public static function valid(RequestModel $request){
        if( !$request->message ){
            return new RequestValidate(false,ResponseStatusModel::RESPONSE_FAIL,'input error');
        }
        return new RequestValidate(true,ResponseStatusModel::RESPONSE_SUCCESS,'SUCCESS');
    }
}