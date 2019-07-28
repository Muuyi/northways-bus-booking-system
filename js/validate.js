//PASSWORD VALIDATION
function ValidatePassword(pass1,pass2,passresponse){
	var pass = $("#pass1").val();
	var pass2 = $("#pass2").val();
	if(pass == ''){
		$("#passResponse").text("Please fill in the new password value!");
	}else if(pass != pass2){
		$("#passResponse").text("The value entered does not match");

	}
}