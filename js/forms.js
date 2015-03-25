function formhash (form, password){
	var p = document.createElement("input");

	form.appendChild(p);
	p.name = "p";
	p.type = "hidden";
	p.value = hex_sha512(password.value);

	password.value = "";

	form.submit();
}

function regformhash(form, uid , email, password, confirmpass, location){

	if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          confirmpass.value == ''		||
          location.value == ''
          ) 
	{ 
        alert('You must provide all the requested details. Please try again');
        return false;
    }

    re = /^\w+$/;
    if(!re.test(form.username.value)){
    	alert('Username must contain only letters, numbers and undersocre');
    	form.username.focus();
    	return false;
    }
    if (password.value.length < 6){
    	alert('Password must be at least 6 characters long. Please try again');
    	form.password.focus();
    	return false;
    }

    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    if(!re.test(password.value)){
    	alert('Passwords must contain at least one number, one lowercase and one uppercase letter. Please try again');
    	return false;
    }

    if(password.value != confirmpass.value){
    	alert ('Your password and confirmation do not match. Please try again');
    	form.password.focus();
    	return false;
    }

    var p = document.createElement("input");
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);

    password.value = "";
    confirmpass.value = "";
    form.submit();
    return true;
}

function submitForm(){
    var p = document.createElement("input");
    form.appendChild(p);
    form.submit();
    return true;
}