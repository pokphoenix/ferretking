<?php

if (isset($_POST['dataTeams']) && $_POST['dataTeams'] != ""){
	$table = $_POST['dataTeams'] ;
	if (isset($_POST['match']) && $_POST['match'] != "" && isset($_POST['teamName']) && $_POST['teamName'] != ""){
		$setRound = setMatchWinner($_POST['match']) - 1  ; // -1 because array index start at 0 
		if ($_POST['match']<15){
			if ($_POST['match']%2==0) {
				$table[$setRound]['team_away'] = $_POST['teamName'] ;
			}else{
				$table[$setRound]['team_home'] = $_POST['teamName']  ;
			}
		}else{
			$table[$setRound]['team_winner'] = $_POST['teamName']  ;
		}

		
		// insert data to db
	}

	
	$data['table'] = $table ;
	

	echo json_encode($data) ;
}else{
	$data['type'] = "ERROR" ;
	$data['msg'] = "ไม่พบข้อมูล";
	echo json_encode($data) ;
}


function setMatchWinner($match){
	switch ($match) {
		case 1:
		case 2:
			$res = 9 ;
			break;
		case 3:
		case 4:
			$res = 10 ;
			break;
		case 5:
		case 6:
			$res = 11 ;
			break;	
		case 7:
		case 8:
			$res = 12 ;
			break;
		case 9:
		case 10:
			$res = 13 ;
			break;
		case 11:
		case 12:
			$res = 14 ;
			break;
		case 13:
		case 14:
			$res = 15 ;
			break;
		case 15:
			$res = 16 ;
			break;	
	}
	return $res ;
}

?>