<?php
$host = "localhost"; 
$user = "root";
$pass = "";
$db_name = "sri_thirumala_transport";
$con = mysql_connect($host, $user, $pass);
mysql_select_db($db_name,$con);


/* Dog Price */

define("PER_DOG_PRICE","1000");
define("PER_DOG_PRICE_TAX","30");
define("TOTAL_PRICE","1030");

/* online URL */
define("ONLINE_URL","https://www.dogsnshows.com");


?>