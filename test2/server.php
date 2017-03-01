<?php

if (isset($_POST['teams']) && $_POST['teams'] != ""){
	$teams = $_POST['teams'] ;
	// shuffle($teams);
	$num_teams = count($teams) - 1;
	$table = [];
	// Generate the pairings for each round.
	for ($round = 0; $round < $num_teams; $round++) {
	    $table[$round]['round'] = $round+1 ;
	    $table[$round]['team'] = [];
	    $matchs_done = [];

	   
	    // Pair each home except the last.
	    for ($home = 0; $home < $num_teams; $home++) {
	        if (!in_array($home, $matchs_done)) {
	            // Select away.
	            $away = $round - $home;
	            $away += ($away < 0) ? $num_teams : 1;

	            $team_home = $teams[$home];
	            $team_away = $teams[$away];

	            // Ensure away is not the current home.
	            if ($away != $home) {
	                // Choose colours.
	                if (($home + $away) % 2 == 0 xor $home < $away) {
	                    // home plays white.
	                    $match = [
	                    	'team__home_name' => $team_home,
	                    	'team_away_name' => $team_away
	                    ] ;
	                    array_push($table[$round]['team'] ,$match);
	                } else {
	                    // home plays black.
	                    $match = [
	                    	'team__home_name' => $team_away,
	                    	'team_away_name' => $team_home
	                    ] ;
	                    array_push($table[$round]['team'] ,$match);
	                }

	                // This pair of homes are done for this round.
	                $matchs_done[] = $home;
	                $matchs_done[] = $away;
	            }
	        }
	    }

	    // Pair the last home.
	    if ($round % 2 == 0) {
	        $team_home = $teams[$num_teams];
	        $away = ($round + $num_teams) / 2;
	        $team_away = $teams[$away];
	        // Last home plays white.
	        $match = [
                    	'team__home_name' => $team_home,
                    	'team_away_name' => $team_away
	                 ] ;
	        array_push($table[$round]['team'] ,$match);
	    } else {
	        $away = ($round + 1) / 2;
	        // Last home plays black.
	        $match = [
	                    'team__home_name' => $team_away,
	                    'team_away_name' => $team_home
	                 ] ;
	        array_push($table[$round]['team'] ,$match);
	    }
	   
	}
	$data['table'] = $table ;
	echo json_encode($data) ;
}else{
	$data['type'] = "ERROR" ;
	$data['msg'] = "ไม่พบข้อมูล";
	echo json_encode($data) ;
}




?>