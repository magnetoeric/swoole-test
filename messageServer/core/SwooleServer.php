<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-1
 * Time: 下午3:41
 */
namespace Core;
use Model\RequestModel;
use Model\ResponseModel;
use Model\ResponseStatusModel;
use Model\RequestValidate;
class SwooleServer extends \Swoole\WebSocket\Server{
    
    private $room;
    private $mapper;
    private $config;
    private $auth;
    private $container;
    public function __construct($container){
        $this->container = $container;
        $this->auth = $this->container->auth;
        $this->mapper = $this->container->mapper;

        $this->config = $container->config;
        $serverConfig = $this->config->get('server');
        parent::__construct($serverConfig['host'],$serverConfig['port']);
        $this->set(array('task_worker_num' => $serverConfig['task_worker_num'],$serverConfig['worker_num']));
        $this->setCallback();
    }
   
    private function setCallback(){
        $this->on('Open',function($server,$req){
            $this->room  = $this->container->room;
            $group = substr($req->server['request_uri'],1);
            if(!$group || !isset($req->get)){
                $server->push($req->fd,json_encode(new ResponseModel(ResponseStatusModel::RESPONSE_NO_AUTH,'auth fail','')));
                $server->close($req->fd);
                return ;
            }
            if(!$this->auth->valid($req->get['type'],$req->get['appKey'],$group)){
                $server->push($req->fd,json_encode(new ResponseModel(ResponseStatusModel::RESPONSE_NO_AUTH,'auth fail','')));
                $server->close($req->fd);
                return ;
            }
            $server->push($req->fd,json_encode(new ResponseModel(ResponseStatusModel::RESPONSE_SUCCESS,'connect success')));
            $server->room->join($req->fd,$group);

            return ;
        });
        $this->on('Message',function($server,$frame){
            $act = json_decode($frame->data);
            if(!is_object($act)){
                $server->push($frame->fd,json_encode(new ResponseModel(ResponseStatusModel::RESPONSE_BAD_REQUEST,'bad request','')));
                return ;
            }
            $request  = $server->mapper->map($act,new RequestModel());
            $r  = RequestValidate::valid($request);
            if(!$r->valid){
                $server->push($frame->fd,json_encode(new ResponseModel($r->status,$r->msg)));
                return ;
            }

            if(!$request->message){
                $server->push($frame->fd,json_encode(new ResponseModel(ResponseStatusModel::RESPONSE_NO_AUTH,'empty message','')));
                return;
            }
            $request->fd = $frame->fd;
            $server->task(json_encode($request));
            $server->push($frame->fd,json_encode(new ResponseModel(ResponseStatusModel::RESPONSE_SUCCESS,'send success')));
            return ;
        });
        $this->on('Close',function($server,$fd){
            $server->room->leave($fd);
        });
        $this->on('Task',function($server, $task_id, $from_id, $data){
            $data = json_decode($data);
            foreach ($server->connections as $fd){
                if($fd!=$data->fd){
                    $server->push($fd, $data->message);
                }
            }
        });
        $this->on('Finish', function ($server, $task_id, $data) {

        });

    }
   
}