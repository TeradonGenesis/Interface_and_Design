function validateForm() {
	var name = document.forms["formBuy"]["fname"].value;
	var quantity = document.forms["formBuy"]["product-quantity"].value;
	var pattern = /^[a-zA-Z]+$/;
	
	if (name == "") {
		alert("Name must be filled out");
        return false;
	}
	
	if (!pattern.test(name)) {
		alert("Name can only consist of letters");
		return false;
	}
}

function validateVIP() {
	var fname=document.forms["formAddVip"]["fname"].value;
	var lname=document.forms["formAddVip"]["lname"].value;
	var email=document.forms["formAddVip"]["vipmail"].value;
	var phone=document.forms["formAddVip"]["phone"].value;
	
	
	var patternName = /^[a-zA-Z]+$/;
	var patternPhone = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;
	var patternMail = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
	
	var error="";
	
	if (fname == "") {
		alert("First name must be filled out");
        return false;
	}
	
	if (!patternName.test(fname)) {
		alert("First name can only consist of letters");
		return false;
	}
		
	if (lname == "") {
		alert("Last name must be filled out");
        return false;
	}
	
	if (!patternName.test(lname)) {
		alert("Last name can only consist of letters");
		return false;
	}
	
	if (email == "") {
		alert("Enter email");
        return false;
	}
	
	if (!patternMail.test(email)) {
		alert("Please fill in valid email");
		return false;
	}

	if (phone == "") {
		alert("Please enter phone number");
        return false;
	}
	
	if (!patternPhone.test(phone)) {
		alert("Please fill in valid phone number");
		return false;
	}
}

function validateMax(max) {
	var current = document.forms["buyItem"]["quantity"].value;
	if(parseInt(current) < 0 || isNaN(current)) {
		return 0; 
	}
	else if(parseInt(current) > max) {
		return max; 
	}
	else {
		return current;
    }
}