//splash.js

$("#test").click(function(){
	alert("get clicked");
});

alert("woah");
$("#submit").click(function() {
	var user = $("#email").val();
	var pass = $("#password").val();
	$.get("login.php?email="+user+"&password="+pass, function(response){
		var myObj = JSON.parse(response);
		if (myObj.success && myObj.loginCheck) {
			Cookies.remove('loginId');
			Cookies.set('loginId', myObj.id);
			document.location.replace('selector.html');
		}
		else {
			alert('failed to login.');
		}
	});
});
