<?php
/**
 * Created by PhpStorm.
 * User: Cshiwei
 * Date: 2016/10/25
 * Time: 16:40
 */

require('http/HttpJob.php');
require('socket/SocketServer.php');

class WebServer {

    /**web服务器的监听端口
     * @var
     */
    private $port;

    /**web服务器的根目录
     * @var
     */
    private $webDoc;

    public function __construct($port)
    {
        $this->port = $port;
        $this->httpJob = new HttpJob();
    }

    public function exe()
    {
        $sock = new SocketServer($this->port);
        $sock->exe();
        if(!$sock)
        {
            $error = $sock->getError();
            var_dump($error);
        }
        else
        {
            do {
                $connection = $sock->getConnections();
                $request = $connection->getClientMsg();
                $response = $this->httpJob->exe($request);
                $connection->send($response);
            }while(true);
        }
    }

    /**
     * @param mixed $webDoc
     */
    public function setWebDoc($webDoc)
    {
        $this->webDoc = $webDoc;
    }

    private function getResponse($request)
    {
        $httpParser = new HttpParser($request);

    }
}
