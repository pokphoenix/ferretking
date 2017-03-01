<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="../jquery-1.12.4.min.js"></script>
	
</head>
<body>
	กรุณากรอกชื่อทีม : 
	<textarea type="text" rows="5" cols="100" id="team" placeholder="ตัวอย่าง Muangthong United,BEC Tero Sasana,Siam Navy,Suphanburi,Ubon UMT,Bangkok United,Port F.C.,Thai Honda,Ratchaburi F.C.,Chiangrai United,Nakhon Ratchasima,Chonburi,Sukhothai,Osotspa F.C" ></textarea> 
	<button  type="button" >send</button>
	<BR>
	ตัวอย่างข้อมูล  Muangthong United,BEC Tero Sasana,Siam Navy,Suphanburi,Ubon UMT,Bangkok United,Port F.C.,Thai Honda,Ratchaburi F.C.,Chiangrai United,Nakhon Ratchasima,Chonburi,Sukhothai,Osotspa F.C

	<div id="arrayResult"></div>
</body>
</html>

<script type="text/javascript">
$("button").on('click', function(event) {
	sendApi().done(setText).fail(alertBox);
});



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
	

	// var arrayteams = ["Muangthong United","BEC Tero Sasana","Siam Navy","Suphanburi","Ubon UMT","Bangkok United","Port F.C.","Thai Honda","Ratchaburi F.C.","Chiangrai United","Nakhon Ratchasima","Chonburi","Sukhothai","Osotspa F.C"] ;

  	$.ajax({
  		method :'POST',
  		data:{teams:arrayteams},
        url: 'server.php',
        dataType: "json",
        success: function(data)
        {	
        	if (data.type=== undefined ){
        		deferred.resolve( JSON.stringify(data));
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

function setText(data){
	$("#arrayResult").text(data);
}


</script>