function regValidate() {
	var username=document.forms["formReg"]["username"].value;
	var email=document.forms["formReg"]["email"].value;
	var memPass=document.forms["formReg"]["password"].value;
	var passwordConfirm=document.forms["formReg"]["passwordConfirm"].value;
	
	
	var patternSpecial = /^[^*|\":<>[\]{}`\\()';@&$]+$/;
	var patternMail = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
	
	var error="";
	
	if (username == "") {
		alert("Username must be filled out");
        return false;
	}
	
	if (!patternSpecial.test(username)) {
		alert("Username cannot consist of special characters");
		return false;
	}
		
	if (memPass == "") {
		alert("Password must be filled out");
        return false;
	}
	
	if (memPass.length < 5) {
		alert("Password must be at least 5 characters long");
		return false;
	}
	
	if (email == "") {
		alert("Please enter email");
        return false;
	}
	
	if (!patternMail.test(email)) {
		alert("Please fill in valid email");
		return false;
	}
	
	if (passwordConfirm != memPass) {
		alert("Passwords to do not match");
		return false;
	}
}