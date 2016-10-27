# Cswweb
一个使用PHP编写的Web服务器

 最近公司项目用到Socket技术，感觉很有意思，既然HTTp协议是基于TCP协议的，那为什么不可以使用PHP的socket实现一个web服务器呢，于是。。。
 演示地址：http://118.192.142.84:8090/test/index.php
##相关标签

 1.http协议，socket协议。
 
 2.PHP，多进程，守护进程
 
 3.面向对象
 
 4.Webserver
 
 
##使用方法

  1.使用起来很简单，首先需要指定一个未被占用的端口号，并且确保防火墙放行，在`index.php`里指定端口`$port={your port}`.
  
  2.接下来需要更改一下配置文件，所有的配置文件位于lib/conf目录下,HttpConf.php保存的是web服务器相关配置，HttpStatus.php保存的是http协议状态码对应含义
  .需要更改一下网站的根目录，默认访问页面和允许访问的文件类型。<br>
  `$_config['wwwRoot']={your webroot}`<br>
  `$_config['defIndex']={your Index}`<br>
  `$_config['allowFile']={your allow}`<br>
  
  3.配置更改完成后，只需要命令行启动，运行index.php即可<br>
  就像这样`php index.php`<br> 不加参数表示调试模式启动，你可以在代码里添加调试信息，会直接显示在终端。<br>
  <br>
  如果加上参数`php index.php -d` 就会以守护进程方式启动,系统会打印出web服务的进程ID，方便随时Kil
  <br>
  
##注意事项
  
  1.由于用到PHP多进程相关函数，本系统只可在Linux下运行。
  
  2.只可以在CLI模式下启动。
  
  3.确保你的PHP版本支持socket。
 
  ##Just for fun :)
