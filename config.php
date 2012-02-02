<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "utang";

function dbconnect()
{
	global $dbhost, $dbuser, $dbpass, $dbname;
	mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());
	mysql_select_db($dbname);
}

error_reporting(E_PARSE);
?>