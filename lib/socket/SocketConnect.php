<?php
/**
 * Created by PhpStorm.
 * User: Cshiwei
 * Date: 2016/10/21
 * Time: 16:31
 */

class SocketConnect {

    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }


    public function send($msg)
    {
        socket_write($this->connection,$msg,strlen($msg));
    }

    public function getClientIp()
    {
        socket_getpeername($this->connection,$add);
        return $add;
    }

    public function getClientMsg()
    {
        $msg = socket_read($this->connection,2048);
        return $msg;
    }

    public function close()
    {
        socket_close($this->connection);
    }

}