<?php
/** 用于创建socket监听
 * Created by PhpStorm.
 * User: Cshiwei
 * Date: 2016/10/20
 * Time: 16:32
 */
require('SocketInterface.php');
require('SocketConnect.php');

class SocketServer implements SocketInterface{

    private $port;

    private $socket;

    private $connections=array();

    public function __construct($port)
    {
        $this->port = $port;
        $this->socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);    //创建的socket基于tcp协议
    }

    public function setPort($port)
    {
        $this->port = $port;
    }

    public function exe()
    {
        if(! $this->socket)
            return false;

        $res = socket_bind($this->socket,'0.0.0.0',$this->port);
        if(! $res)
            return false;

        $res = socket_listen($this->socket,10);
        if(! $res)
            return false;
    }

    public function getConnections()
    {
        $connection = socket_accept($this->socket);
        $connection = new SocketConnect($connection);
        return $connection;
    }

    public function getError()
    {
        $errorCode = socket_last_error();
        $errorMsg = socket_strerror($errorCode);

        return array(
            'errorCode' => $errorCode,
            'errorMsg'  => $errorMsg,
        );
    }


    public function onConected()
    {
        echo "连接成功，接收到的数据是!";
       /* $msg ="测试成功！\n";
        socket_write($this->connection, $msg, strlen($msg));*/
        $msg = socket_read($this->connection,1024);
        var_dump($msg);
        // TODO: Implement onConected() method.
    }

    public function onMessage()
    {
        // TODO: Implement onMessage() method.
    }

    public function onSend()
    {
        // TODO: Implement onSend() method.
    }

    public function onClose()
    {
        // TODO: Implement onClose() method.
    }

    public function send()
    {
        // TODO: Implement send() method.
    }

    public function receive()
    {
        // TODO: Implement receive() method.
    }

    public function close()
    {
        // TODO: Implement close() method.
    }
}
