<?php
error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
# FileName="Connection_php_mysql.html"
# Type="MYSQL"
# HTTP="true"
$hostname_testelogin = "localhost";
$database_testelogin = "testelogin";
$username_testelogin = "root";
$password_testelogin = "321";
$testelogin = mysql_connect($hostname_testelogin, $username_testelogin, $password_testelogin) or trigger_error(mysql_error(),E_USER_ERROR);
?>