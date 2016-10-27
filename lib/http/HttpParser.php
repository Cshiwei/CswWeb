<?php
/**解析http报文
 * Created by PhpStorm.
 * User: Cshiwei
 * Date: 2016/10/21
 * Time: 17:22
 */

class HttpParser {

    /**http请求字符串
     * @var
     */
    private $httpStr;

    /**方法 get OR post OR eg。
     * @var
     */
    private $method;

    /**包括get请求信息的url
     * @var
     */
    private $url='';

    /**真实的地址，不包括get数据
     * @var
     */
    private $realUrl='';

    /**浏览器传来的数据
     * @var
     */
    private $data=array();

    /**使用的http协议版本
     * @var
     */
    private $protocol;

    public function __construct($httpStr)
    {
        $this->httpStr = $httpStr;
    }

    public function parser()
    {
        $arr = explode("\n",$this->httpStr);
        $requestRow = $arr[0];
        $this->parserRow($requestRow);
       /* unset($arr[0]);
        foreach($arr as $key=>$val)
        {
            $tmp = explode(': ',$val);
            $requestBody[$tmp[0]] = $tmp[1];
        }*/
    }

    /**解析请求行
     * @param $strRow
     */
    private function parserRow($strRow)
    {
        $strRow = trim($strRow,' ');
        $arr = explode(' ',$strRow);

        $this->method = $arr[0];
        $this->url = isset($arr[1]) ? $arr[1] : '';
        $this->protocol = isset($arr[2]) ? $arr[2] : '';

        $this->setRealUrl($this->url);
        $this->setKeyValue($this->url);
    }

    /**设置真实url地址
     * @param $strUrl
     */
    private function setRealUrl($strUrl)
    {
        $arr = explode('?',$strUrl);
        $this->realUrl = $arr[0];
    }

    /**
     * @return mixed
     */
    public function getRealUrl()
    {
        return $this->realUrl;
    }


    /**从get字符串中获取name和value
     * @param $url
     * @return array
     */
    private function setKeyValue($url) {
        $result = array();
        $mr = preg_match_all('/(\?|&)(.+?)=([^&?]*)/i', $url, $matchs);
        if ($mr !== FALSE) {
            for ($i = 0; $i < $mr; $i++) {
                $result[$matchs[2][$i]] = $matchs[3][$i];
            }
        }
        $this->data = $result;
    }

    /**
     * @return mixed
     */
    public function getHttpStr()
    {
        return $this->httpStr;
    }

    /**获取请求方法
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**获取请求的地址及
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
