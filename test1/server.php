<?php

if (isset($_POST['number']) && $_POST['number'] != ""){
	$number = $_POST['number'] ;
	sort($number,1) ;
	$data['result'] = $number ;
	echo json_encode($data) ;
}else{
	$data['type'] = "ERROR" ;
	$data['msg'] = "ไม่พบข้อมูล";
	echo json_encode($data) ;
}




?>