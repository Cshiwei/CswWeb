<?php
/**组建http报文
 * Created by PhpStorm.
 * User: Cshiwei
 * Date: 2016/10/21
 * Time: 17:27
 */
require_once('/home/www/svnwww/Webserver/lib/tools/Config.php');
class HttpBuilder{

    private $config;

    /**最终的http字符串
     * @var
     */
    private $httpStr;

    /**http协议
     * @var string
     */
    private $protocol = 'HTTP/1.1';

    /**
     * @var string
     */
    private $status = '200 OK';

    /**http响应头信息
     * @var
     */
    private $httpHeader = '';

    /**http响应正文
     * @var string
     */
    private $httpBody = '';

    public function __construct()
    {
        $this->config = new Config('HttpStatus');
    }

    /**
     * @return mixed
     */
    public function getHttpStr()
    {
        $httpRow = $this->setHttpRow();
        $httpHeader = $this->httpHeader;
        $httpBody = $this->httpBody;

        $httpStr = $httpRow.$httpHeader.$httpBody;

        return $httpStr;
    }

    private function setHttpRow()
    {
        return $this->protocol.' '.$this->status."\r\n";
    }

    public function setHttpHeader($headerArr)
    {
        foreach($headerArr as $key=>$val)
        {
            $this->httpHeader.=$key.': '.$val."\r\n";
        }
        $this->httpHeader.="\r\n";
        return $this;
    }

    public function setHttpBody($httpBody)
    {
        $this->httpBody = $httpBody;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     * @return $this
     */
    public function setProtocol($protocol='HTTP/1.1')
    {
        $this->protocol = $protocol;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return $this
     */
    public function setStatus($status='200')
    {
        $statusArr = $this->config->item('status');

        if(array_key_exists($status,$statusArr))
        {
            $this->status = $status.' '.$statusArr[$status];
        }

        return $this;
    }
}