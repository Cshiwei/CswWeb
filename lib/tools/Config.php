<?php
/**用于加载配置文件，
 * Created by PhpStorm.
 * User: Cshiwei
 * Date: 2016/10/26
 * Time: 11:26
 */

class Config {

    /**配置文件路径
     *
     * @var string
     */
    private $configPath = '/home/www/svnwww/Webserver/lib/conf/';

    /**配置文件后缀
     * @var string
     */
    private $postfix = 'php';

    private $config=array();

    public function __construct($conf)
    {
        $filename  = $conf.'.'.$this->postfix;
        $filepath = $this->configPath.$filename;
        if(file_exists($filepath))
        {
            require($filepath);
            $this->config = $_config;
        }
    }

    /**获取配置项
     * @param $key
     * @return bool
     */
    public function item($key)
    {
        if(isset($this->config[$key]))
            return $this->config[$key];

        return false;
    }



}