<?php

require '../connect.php';

ini_set('default_charset','utf-8');

$salesDate = date("Y-m-d H:i:s");

$pay = json_decode (file_get_contents('php://input'));

file_put_contents("/home/storage/8/1b/7c/hpgosft/public_html/snapay/log/log.log", "Log",FILE_APPEND);

file_put_contents("/home/storage/8/1b/7c/hpgosft/public_html/snapay/log/log.log", file_get_contents('php://input'),FILE_APPEND);

foreach (getallheaders() as $name => $value) {

file_put_contents("/home/storage/8/1b/7c/hpgosft/public_html/snapay/log/log.log", "$name: $value\n",FILE_APPEND);
}

//sleep (1);

if ($pay->password != "1234"){

	$result = array("result" => FALSE, "message"  => "invalid_password");

	echo json_encode($result);

	return;
}



$aprova = rand(1, 99);
$code = rand(11111111, 99999999);

//sleep (3);

header('Content-Type: application/json; > charset=utf-8');

if($aprova < 80){

	$sql = "INSERT INTO `sales` (`date`, `amount`, `id_transaction`, `status`) VALUES ('$salesDate', $pay->amount, $code, 'Aprovado');";

	$result = array("result"  => TRUE,"nsu" => $aprova);

	$query = mysql_query($sql);

	echo json_encode($result);

}

else{

	$sql = "INSERT INTO `sales` (`date`, `amount`, `id_transaction`, `status`) VALUES ('$salesDate', $pay->amount, 0, 'Reprovado');";

	$result = array("result"  => FALSE, "message" => "try_again");

	$query = mysql_query($sql);

	echo json_encode($result);

}

?>