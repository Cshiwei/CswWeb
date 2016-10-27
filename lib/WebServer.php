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

    private $type;

    /**web服务器的监听端口
     * @var
     */
    private $port;

    /**web服务器的根目录
     * @var
     */
    private $webDoc;

    public function __construct($port,$argv)
    {
        $this->port = $port;
        $this->getParams($argv);
        $this->httpJob = new HttpJob();
    }

    public function exe()
    {
        switch($this->type)
        {
            case 'damon' :
                $pid = pcntl_fork();
                if($pid)
                {
                    echo "以守护进程方式运行...\n";
                    echo "PID:\n";
                    echo "{$pid}\n";
                }
                else
                {
                    $this->job();
                }
                break;

            default :
                $this->job();
        }
    }

    private function job()
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

    private function getParams($argv)
    {
        if(isset($argv[1]) && $argv[1]=='-d')
        {
            $this->type = 'damon';
        }
    }
}
