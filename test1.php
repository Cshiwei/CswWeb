<?php
/**测时php进程间通信
 * Created by PhpStorm.
 * User: Cshiwei
 * Date: 2016/10/24
 * Time: 11:13
 */

//echo getprotobyname('ipc');
//$sock = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);

//socket_bind($sock,'/tmp/php-cgi.sock');
//socket_connect($sock,'/tmp/php-cgi.sock');
/*socket_connect($sock,'127.0.0.1','8090');

socket_write($sock,$msg,8);*/


$sock = socket_create(AF_UNIX,SOCK_STREAM,0);
//socket_bind($sock,'/tmp/test4.sock');
$res = socket_connect($sock,'/tmp/php-cgi.sock');
var_dump($res);
if($res)
{
    $a ='ZSCRIPT_FILENAME/home/www/svnwww/test/test.php
                                              QUERY_STRINGREQUEST_METHODGET
                                                                           CONTENT_TYPECONTENT_LENGTH
                                                                                                     SCRIPT_NAME/+e_+/+e_+.-h-
    REQUEST_URI/+e_+/+e_+.-h-
    DOCUMENT_URI/+e_+DOCUMENT_ROOT/h-+e/+++/_++++SERVER_PROTOCOLHTTP/1.1REQUEST_SCHEMEh++-GATEWAY_INTERFACECGI/1.1
                                                                                             SERVER_SOFTWAREnginx/1.10.0
                                                                                                                        REMOTE_ADDR114.250.99.101
                                                                                                                                                 REMOTE_PORT52682
                                                                                                                                                                 SERVER_ADDR118.192.142.84
                  SERVER_PORT80

                               SERVER_NAME+++.+++-.-_gREDIRECT_STATUS200        HTTP_HOST118.192.142.84
HTTP_CONNECTIONkeep-alive       HTTP_CACHE_CONTROLmax-age=0HTTP_UPGRADE_INSECURE_REQUESTS1lHTTP_USER_AGENTMozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36
                                              JHTTP_ACCEPTtext/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8HTTP_ACCEPT_ENCODINGgzip, deflate, sdchHTTP_ACCEPT_LANGUAGEzh-CN,zh;-=0.8';

    $res = socket_write($sock,$a,strlen($a));
    var_dump($res);
    /*$msg = socket_read($sock,2048);
    var_dump($msg);*/
}

