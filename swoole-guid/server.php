<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17-6-12
 * Time: 上午10:31
 */
class server extends \Swoole\Server{
    private $guid;
    const SERVICE_ID = 1;
    const START_TIME = 1497196800; //2017/6/12 00:00:00
    public function __construct()
    {
        cli_set_process_title('guid-server');
        parent::__construct("127.0.0.1",9501);
        $this->guid = new swoole_atomic(0);
        $this->set(array(
        'worker_num' => 8,
        'daemonize' => false,
    ));
        $this->setCallBack();
    }
    private function setCallBack(){
        $this->on('connect', function ($serv, $fd){
        });
        $this->on('receive', function ($serv, $fd, $from_id, $data) {
            $serv->send($fd,$this->generateId().PHP_EOL);
            $serv->close($fd);
        });
        $this->on('close', function ($serv, $fd) {
        });
    }
    private function generateId(){
        $this->guid->add(1);
        $first = self::SERVICE_ID;
        $second = time()-self::START_TIME;
        $third = ($this->guid->get())%(1<<13);//单机最多不能超过2的13次方
        //4位给机器,31位给时间戳　大概40年,13位给顺序号　其余的作为扩展位放在最前
        $result = ($first<<44)+($second<<13)+$third;
        return $result;
    }
    public function reverse($id){
        $third = $id & ((1<<13)-1);
        $id  = ($id >> 13);
        $second = $id & ((1<<31) -1);
        $id = ($id >> 31);
        $first = $id & ((1<<4)-1);
        var_dump($first);
        var_dump($second);
        var_dump($third);
    }



}
$server = new server();
$server->start();
//$server->reverse(17592641670977);
