# Cswweb
一个使用PHP编写的Web服务器

 最近公司项目用到Socket技术，感觉很有意思，既然HTTp协议是基于TCP协议的，那为什么不可以使用PHP的socket实现一个web服务器呢，于是。。。
 
##使用方法

  1.使用起来很简单，首先需要指定一个未被占用的端口号，并且确保防火墙放行，在`index.php`里指定端口`$port={your port}`.
  
  2.接下来需要更改一下配置文件，所有的配置文件位于lib/conf目录下,HttpConf.php保存的是web服务器相关配置，HttpStatus.php保存的是http协议状态码对应含义
  .需要更改一下网站的根目录，默认访问页面和允许访问的文件类型。`//网站根目录路径
$_config['webRoot'] = '/home/www/svnwww/';

//默认访问的文件
$_config['defIndex'] = array('index.php','index.html');

//允许访问的文件类型
$_config['allowFile'] = array('php','html','jpg');
`
  
  
  只需要命令行启动，运行index.php即可<br>
  就像这样`php index.php`<br> 不加参数表示调试模式启动，你可以在代码里添加调试信息，会直接显示在终端。<br>
  <br>
  如果加上参数`php index.php -d` 就会以守护进程方式启动,系统会打印出web服务的进程ID，方便随时Kil
  <br>
 
  
