<?php

$db_host = '127.0.0.1';
$db_user = 'root';
$db_name = 'word';
$db_pass = 'root';
$db_table= 'main';

$link = @mysql_connect($db_host,$db_user,$db_pass) or die("提示：数据库连接失败！");
mysql_select_db($db_name,$link);
mysql_set_charset('utf8',$link);

?>