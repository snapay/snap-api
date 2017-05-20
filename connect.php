<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set('America/Sao_Paulo');

/* config */
$db_host		= 'modpay.mysql.dbaas.com.br';
$db_user		= 'modpay';
$db_pass		= '*********';
$db_database	= 'modpay';
/* End config */

$link = mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');
mysql_select_db($db_database,$link);

?>
