<?php
	require '../connect.php';

	$filter  = isset($_GET['filter']) ? strval($_GET['filter']) : '';
   
    ini_set('default_charset','utf-8');
    header('Content-Type: json/plain; > charset=utf-8');
	
	$where = "";
	$today = date('Y-m-d');
	
	//debug
	//echo $today;

	if ($filter=="")
	{
		$where = $where." date >= '".$today."'";
	}
	if ($filter=="week")
	{
		$where = $where." date >= '". date('Y-m-d', strtotime($today .'-7 day'))."'";
	}
	if ($filter=="month")
	{
		$where = $where." date >= '". date('Y-m-d', strtotime($today .'-1 month'))."'";
	}




	$textq = "select * from sales";

	if ($where<>"")
	{
		$textq = $textq." where ".$where;
	}

	
        
	//debug
	//echo $textq;

	$rs = mysql_query($textq,$link);
	
	//print_r($rs);

	$items = array();
	while($row = mysql_fetch_object($rs)){
  
		$row->date = date( 'd/m/Y H:i:s', strtotime($row->date));
  
	    array_push($items, $row);
	   
	}
	
	//print_r($items);
       //echo "---------------------------------------------------------------------\n";
	echo json_encode($items);
?>