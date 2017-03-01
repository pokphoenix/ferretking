<?php

if (isset($_POST['teams']) && $_POST['teams'] != ""){
	$teams = $_POST['teams'] ;
	$num_teams = (count($teams)/2);

	for ($round = 0; $round < $num_teams; $round++) {
	    $table[$round]['match'] = $round+1 ;
	    $table[$round]['team_home'] = $teams[(2*$round)] ;
	    $table[$round]['team_away'] = $teams[(2*$round)+1] ;
	}

	$teams_round = count($teams)-1;
	$count_rouund2 = (count($teams)-$num_teams) ;
	for ($round2 = $count_rouund2 ; $round2 < $teams_round; $round2++) {
	    $table[$round2]['match'] = $round2+1 ;
	    $table[$round2]['team_home'] = "" ;
	    $table[$round2]['team_away'] = "" ;
	}

	$final_round = count($teams)-1 ;
	$table[$final_round]['match'] = "final" ;
	$table[$final_round]['team_winner'] = "" ;
	
	$data['table'] = $table ;
	
	//  insert data to DB 
	echo json_encode($data) ;
}else{
	$data['type'] = "ERROR" ;
	$data['msg'] = "ไม่พบข้อมูล";
	echo json_encode($data) ;
}
?>