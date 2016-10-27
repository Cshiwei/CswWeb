<?php
/** socket进程间通信
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/24
 * Time: 11:13
 */
/*$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
socket_bind($socket,'127.0.0.1','8090');
socket_listen($socket);

do
{
    $connection = socket_accept($socket);
    socket_getpeername($connection,$add,$port);
    $msg = socket_read($connection,1024);
    echo "客户端IP:\n";
    echo $add.':'.$port."\n";
    echo "客户端提交内容:\n";
    echo $msg;
}while(true);*/

$socket = socket_create(AF_UNIX,SOCK_STREAM,0);
socket_bind($socket,'/tmp/test.sock');
socket_listen($socket);
do
{
    $connection = socket_accept($socket);
    socket_getsockname($connection,$add);
    $msg = socket_read($connection,1024);
    echo "客户端IP:\n";
    echo $add."\n";
    echo "客户端提交内容:\n";
    echo $msg;
}while(true);


