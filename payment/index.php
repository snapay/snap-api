<?php
require '../connect.php';
ini_set('default_charset','utf-8');
header('Content-Type: json/plain; > charset=utf-8');

$salesDate = date("Y-m-d H:i:s");
$pay = json_decode (file_get_contents('php://input'));

if ($pay->password != "1234"){
	$result = array("result"  => "Senha Invalida");
	echo json_encode($result);
	return;
}

$aprova = rand(1, 99);
$code = rand(11111111, 99999999);

if($aprova < 80){
	$sql = "INSERT INTO `sales` (`date`, `amount`, `id_transaction`, `status`) VALUES ('$salesDate', $pay->amount, $code, 'Aprovado');";
	$result = array("result"  => "Aprovado","nsu" => $aprova);
	$query = mysql_query($sql);
	echo json_encode($result);
}
else{
	$sql = "INSERT INTO `sales` (`date`, `amount`, `id_transaction`, `status`) VALUES ('$salesDate', $pay->amount, 0, 'Reprovado');";
	$result = array("result"  => "Reprovado. Tente novamente.");
	$query = mysql_query($sql);
	echo json_encode($result);
}

?>