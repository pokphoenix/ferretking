<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="../jquery-1.12.4.min.js"></script>
	
</head>
<body>
	กรุณากรอกข้อมูล (ตัวอย่าง 5,2,7,1,3,8,4,9,6) : 
	<input type="text" id="number" placeholder="ตัวอย่าง 5,2,7,1,3,8,4,9,6" >
	<button  type="button" >send</button>
	<div id="arrayResult"></div>
</body>
</html>

<script type="text/javascript">
$("button").on('click', function(event) {
	sendApi().done(setText).fail(alertBox);
});



function sendApi(){
	var deferred = $.Deferred();
	var number = $("#number").val();
	if (number == "" || number== " "){
		deferred.reject("กรุณากรอกข้อมูล");
		return deferred.promise();
	}
	var array = number.split(/,/) ;
	var arrayNumbers = [];
	for (var i=0; i < array.length; i++) {
	   arrayNumbers.push(array[i]);
	}
	
  	$.ajax({
  		method :'POST',
  		data:{number:arrayNumbers},
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