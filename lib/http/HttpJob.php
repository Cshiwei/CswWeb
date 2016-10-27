<?php
/**接收http请求并解析，返回相应内容
 * Created by PhpStorm.
 * User: Cshiwei
 * Date: 2016/10/25
 * Time: 16:58
 */
require('HttpParser.php');
require('HttpBuilder.php');
require_once('/home/www/svnwww/Webserver/lib/tools/Config.php');

class HttpJob {

    private $request;

    private $requestArr;

    private $config;

    public function __construct()
    {
        $this->config = new Config('HttpConf');
    }

    public function exe($request)
    {
        $this->parse($request);
        $realUrl = $this->requestArr['realUrl'];
        $res = $this->confirmIndex($realUrl);
        $httpResponse = $this->response($res);
        return $httpResponse;
    }

    private function parse($request)
    {
        $parser = new HttpParser($request);
        $parser->parser();
        $this->requestArr['realUrl'] = $parser->getRealUrl();
    }
    /**
     * @param $str
     * @return int|string
     */
    private function confirmIndex($str)
    {
        $allowFile = $this->config->item('allowFile');
        $defIndex = $this->config->item('defIndex');
        $webRoot = $this->config->item('webRoot');

        foreach($allowFile as $key=>$val)
        {
            $res = preg_match('#\S+.'.$val.'#',$str,$arr);
            if($res)
            {
                $filePath = $webRoot.$arr[0];
                if(file_exists($filePath))
                    return $filePath;

                return 404;
            }
        }

        $dirPath = rtrim($webRoot,'/').'/'.trim($str,'/');
        if(is_dir($dirPath))   //如果存在该目录
        {
            foreach($defIndex as $key=>$val)
            {
                $filePath = $dirPath.'/'.$val;
                if(file_exists($filePath))
                {
                    return $filePath;
                }
            }

            return 403;
        }
        else
        {
            return 404;
        }
    }


    private function response($filePath)
    {
        $httpBulider = new HttpBuilder();

        switch($filePath)
        {
            case '404' :
                $body = $this->getPublicHtml('404');
                $headerArr = array(
                    'Content-Type' => 'text/html',
                    'Connection'   => 'keep-alive',
                    'Content-Length'=> strlen($body),
                );
                $httpBulider->setStatus('404')
                            ->setHttpHeader($headerArr)
                            ->setHttpBody($body);
                break;
            case '403' :
                $body = $this->getPublicHtml('403');
                $headerArr = array(
                    'Content-Type' => 'text/html',
                    'Connection'   => 'keep-alive',
                    'Content-Length'=> strlen($body),
                );
                $httpBulider->setStatus('403')
                            ->setHttpHeader($headerArr)
                            ->setHttpBody($body);
                break;

            default :
                $body = $this->getFileContent($filePath);
                $headerArr = array(
                    'Content-Type' => 'text/html',
                    'Connection'   => 'keep-alive',
                    'Content-Length'=> strlen($body),
                );
                $httpBulider->setStatus('200')
                            ->setHttpHeader($headerArr)
                            ->setHttpBody($body);
        }

        return $httpBulider->getHttpStr();
    }

    private function getPublicHtml($status)
    {
        $filepath = '/home/www/svnwww/Webserver/lib/public/'.$status.'.html';
        if(! file_exists($filepath))
        {
            $status = '404';
            $filepath = '../public/'.$status.'.html';
        }
        $file = file_get_contents($filepath);

        return $file;
    }

    private function getFileContent($filePath)
    {
       // $fileContent = file_get_contents($filePath);
        ob_start();
        include($filePath);
        $response = ob_get_flush();
        return $response;
    }

}

/*$httpJob = new HttpJob(2);
$httpJob->exe();*/