<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="../jquery-1.12.4.min.js"></script>
	<style type="text/css">
		.txt_col{
			width:150px;
		}
		.fl {
			text-align: right;
		}
	</style>
</head>
<body>
	กรุณากรอกชื่อทีม 16 ทีม: 
	<textarea type="text" rows="5" cols="100" id="team"  ></textarea> 
	<button  type="button" >send</button>
	<BR>
	ตัวอย่างข้อมูล  Arsenal,Aston Villa,Blackburn Rovers,Bolton Wanderers,Chelsea,Everton,Fulham,Hull City,Liverpool,Manchester City,Manchester United,Middlesbrough,Newcastle United,Portsmouth,Sunderland,Tottenham Hotspur

	<div id="arrayResult"></div>

</body>
</html>

<script type="text/javascript">
$("button").on('click', function(event) {
	sendApi().done(createTable).fail(alertBox);
});

var dataTeams = [];

function sendApi(){
	var deferred = $.Deferred();
	var team = $("#team").val();
	if (team == "" || team== " "){
		deferred.reject("กรุณากรอกชื่อทีม");
		return deferred.promise();
	}
	var array = team.split(/,/) ;
	var arrayteams = [];
	for (var i=0; i < array.length; i++) {
	   arrayteams.push(array[i]);
	}
	
  	$.ajax({
  		method :'POST',
  		data:{teams:arrayteams},
        url: 'create.php',
        dataType: "json",
        success: function(data)
        {	
        	if ( data.type === undefined ){
        		deferred.resolve(data);
        	}else{
        		deferred.reject(data.msg);
        	} 
        },
        error: function(){
		    deferred.reject();
		}
        	
    });
    return deferred.promise();
}

function alertBox(msg){
	alert(msg);
}

function createTable(data){
	dataTeams = data.table ;
	var html = "<table>";
	for (i in data.table){
		if (data.table[i].match!="final"){
			html += "<tr> <td>match "+data.table[i].match+" )</td> <td> <button type='button' onclick=\"setTeamWin("+data.table[i].match+",'"+data.table[i].team_home+"')\"  >Home Win</button> </td> <td class=\"txt_col fl\">"+data.table[i].team_home+"</td> <td>VS</td> <td class=\"txt_col\">"+data.table[i].team_away+"</td><td><button type='button' onclick=\"setTeamWin("+data.table[i].match+",'"+data.table[i].team_away+"')\"  >Away Win</button></td></tr>";
		}else{
			html+= "<tr> <td>WINNER</td> <td></td> <td class=\"txt_col fl\">"+data.table[i].team_winner+"</td> <td></td> <td class=\"txt_col\"></td><td></td></tr>"
		}
		
	}

	html +="</table>" ;

	$("#arrayResult").html(html);
}

function setTeamWin(match,teamName){
  	$.ajax({
  		method :'POST',
  		data:{match:match,teamName:teamName,dataTeams:dataTeams},
        url: 'update.php',
        dataType: "json",
        success: function(data)
        {	
        	if ( data.type === undefined ){
        		createTable(data)
        	}
        },
        error: function(){
		    
		}
        	
    });
}

</script>