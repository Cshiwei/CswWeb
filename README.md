# Cswweb
一个使用PHP编写的Web服务器

 最近公司项目用到Socket技术，感觉很有意思，既然HTTp协议是基于TCP协议的，那为什么不可以使用PHP的socket实现一个web服务器呢，于是。。。
 
##使用方法
  使用起来很简单，只需要命令行启动，运行index.php即可<br>
  就像这样`php index.php`<br>
  不加参数表示调试模式启动，你可以在代码里添加调试信息，会直接显示在终端。<br>
  如果加上参数`php index.php -d` 就会以守护进程方式启动,系统会打印出web服务的进程ID，方便随时Kil
