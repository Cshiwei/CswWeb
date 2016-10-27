<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/21
 * Time: 8:55
 */
interface SocketInterface {

    //socket建立连接时，触发
    public function onConected();

    //socket获得信息时，触发
    public function onMessage();

    //发送消息后触发
    public function onSend();

    //关闭连接时触发
    public function onClose();

    //发送消息
    public function send();

    //接收消息
    public function receive();

    //socket关闭连接时触发
    public function close();

}