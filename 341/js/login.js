var login = function(){
	$.ajax({
		url:'php/php.php',
		success: function(data){
			alert("worked");
		},
		error: function(){
			alert("error");
		}
	})
}