<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-5-31
 * Time: 下午9:16
 */
namespace Model;
class ResponseModel{
   
    
    public function __construct($status,$message,$data='')
    {
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }

    public $status;
    public $message;
    public $data;
}