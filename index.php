<?php
/**
 * Created by PhpStorm.
 * User:Cshiwei
 * Date: 2016/10/21
 * Time: 14:33
 */

require('lib/WebServer.php');

$port = 8090;
$webServer = new WebServer($port);
$webServer->exe();





